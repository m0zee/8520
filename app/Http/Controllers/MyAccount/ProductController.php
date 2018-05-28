<?php

namespace App\Http\Controllers\MyAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

use App\Product;
use App\ProductGallery;
use App\Category;
use App\Country;
use App\Unit;
use App\Currency;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status_id = NULL)
    {
        $this->query = Product::with( 'user.detail', 'status', 'currency', 'unit', 'sub_category.category' )
        ->where( 'user_id', Auth::user()->id )->orderBy('id', 'DESC');
        if ($status_id == NULL ) {

            $products = $this->query->paginate(12);
        }
        else
        {
            $products = $this->query->where('status_id', $status_id)->paginate(12);
            // $this->data['page_title'] = ''
        }
        $this->data['products'] = $products;

        $data = Product::where( 'user_id', Auth::user()->id );
        if ($status_id != NULL) {
            $count = $data->where('status_id', $status_id)->count();
        }
        else
        {
            $count = $data->count();
        }
        
        
        $this->data['count'] = $count;
        return view( 'frontend.profile.product.list', $this->data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( $this->isProductLimitExceed() )
        {
            return redirect()->back()->with( 'error', 'You have reached your limit. You cannot add any more products.' );
        }

        $this->data['countries']  = Country::pluck( 'name', 'id' );
        $this->data['categories'] = Category::pluck( 'name', 'id' );
        $this->data['units']      = Unit::pluck( 'name', 'id' );
        $this->data['currencies'] = Currency::pluck( 'name', 'id' );

        return view( 'frontend.profile.product.create', $this->data );
    }

    private function isProductLimitExceed()
    {
        return !( Auth::user()->product_limit > Product::where( 'user_id', Auth::user()->id )->count() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $validator = $this->makeValidator( $request );

        if( $validator->fails() )
        {
            return json_encode( ['errors' => $validator->errors() ] );
        }

        $files      = $request->__files[0];
        $filename   = $files->getClientOriginalName();
        $imageName  = time() . '.' .  \File::extension($filename);
        $path       = public_path( 'storage/product' );

        $this->resize_img_and_watermark( $files, $imageName, $path );
        
        $lastProduct    = Product::orderBy( 'id', 'DESC' )->first();
        $code           = ( $lastProduct ) ? $this->generate_code( $lastProduct->code ) : 'pr-0001';

        $data = [
            'name'              => $request->name,
            'slug'              => $this->slugify($request->name),
            'code'              => $code,
            'description'       => $request->description,
            'brand_name'        => $request->brand_name,
            'sub_category_id'   =>$request->sub_category_id,
            'category_id'       => $request->category_id,
            'country_id'        => $request->country_id,
            'max_supply'        => $request->max_supply,
            'unit_id'           => $request->unit_id,
            'currency_id'       => $request->currency_id,
            'price'             => $request->price,
            'img_path'          => $path,
            'img'               => $imageName,
            'user_id'           => Auth::user()->id,
            'status_id'         => 1
        ];

        $product = Product::create( $data );

        return response( [ 'success' => true, 'redirect' => route('my-account.product.add_gallery', $product->code ) ], 200 );
    }

    private function makeValidator( $request )
    {
        return Validator::make( $request->all(), [
            '__files.*'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'brand_name'        => 'required',
            'name'              => 'required',
            'country_id'        => 'required',
            'unit_id'           => 'required',
            'max_supply'        => 'required',
            'currency_id'       => 'required',
            'price'             => 'required',
            'description'       => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $code )
    {
        $this->data['product'] = Product::where( 'code', $code )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail', 'country', 'gallery' )->first();
        $this->data['relativeProducts'] = Product::where( 'code', '!=', $code )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail' )->take( 3 )->get();

        return view( 'frontend.profile.product.show', $this->data );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_code)
    {
        $this->data['countries']  = Country::pluck( 'name', 'id' );
        $this->data['categories'] = Category::pluck( 'name', 'id' );
        $this->data['units']      = Unit::pluck( 'name', 'id' );
        $this->data['currencies'] = Currency::pluck( 'name', 'id' );
        $this->data['product']    = Product::where( 'code', $product_code )->first();

        return view( 'frontend.profile.product.edit', $this->data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_code)
    {
        $product    = Product::where( 'code', $product_code )->first();
        $validator  = Validator::make( $request->all(), [
            '__files.*'         => 'mimes:jpeg,jpg,png|max:2000',
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'brand_name'        => 'required',
            'name'              => 'required',
            'country_id'        => 'required',
            'unit_id'           => 'required',
            'max_supply'        => 'required',
            'currency_id'       => 'required',
            'price'             => 'required',
            'description'       => 'required',
        ]);

        if( $validator->fails() )
        {
            return json_encode( [ 'errors' => $validator->errors() ] );
        }

        $new_imageName = NULL ;

        $files = $request->__files[0];
        // return $files;
        if( $files != '' ) 
        {
            $filename       = $files->getClientOriginalName();
            $new_imageName  = time() . '.' . \File::extension( $filename );
            $path           = public_path( 'storage/product' );
            $this->resize_img_and_watermark( $files, $new_imageName, $path );
        }
        else
        {
            $path           = $product->img_path;
            $old_imageName  = $product->img;
        }

        $data = [
            'name'              => $request->name,
            'description'       => $request->description,
            'brand_name'        => $request->brand_name,
            'sub_category_id'   => $request->sub_category_id,
            'category_id'       => $request->category_id,
            'country_id'        => $request->country_id,
            'max_supply'        => $request->max_supply,
            'unit_id'           => $request->unit_id,
            'currency_id'       => $request->currency_id,
            'price'             => $request->price,
            'img_path'          => $path,
            'img'               => ( $new_imageName != NULL ) ? $new_imageName : $old_imageName,
            'user_id'           => Auth::user()->id,
            'status_id'         => 2
        ];

        Product::where( 'code', $product_code )->update( $data );

        if ( $new_imageName != NULL ) 
        {
            $mainImg = $path . '/' . $product->img;
            if( file_exists( $mainImg ) && is_file( $mainImg ) )
            {
                unlink( $path . '/' . $product->img );
                unlink( $path . '/80x80_' . $product->img );
                unlink( $path . '/361x230_' . $product->img );
            }
        }

        return json_encode( [ 'success' => true ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img_data = ProductGallery::find($id);
        $img_path   = $img_data->path.'/'.$img_data->img;
        $thumb_path = $img_data->path.'/80x80_'.$img_data->img;
        $product_img = $img_data->path.'/361x230_'.$img_data->img;

        $affected = ProductGallery::find($id)->delete();
        if ( $affected > 0 ) 
        {
            if( file_exists( $img_path ) && is_file( $img_path ) )
            {
                unlink( $img_path );
            }

            if( file_exists( $thumb_path ) && is_file( $thumb_path ) )
            {
                unlink( $thumb_path );
            }

            if( file_exists( $product_img ) && is_file( $product_img ) )
            {
                unlink( $product_img );
            }

            echo json_encode( [ 'success' => 'Image has been deleted.' ] ); die;
        }
        else
        {
            echo json_encode( [ 'err' => 'Image could not be deleted. Please try again.' ] ); die;
        }
        
    }



    private function generate_code( $code )
    {
        $code =  explode( '-', $code );

        $index  = $code[1] + 1;

        $length = strlen( $index );

        switch( $length )
        {
            case 1:
                $index = '000' . $index;
            break;
            
            case 2:
                $index = '00' . $index;
            break;

            case 3:
                $index = '0' . $index;
            break;
        }

        $code = 'pr-'. $index;

        return $code;
    }


    public function gallery( $code )
    {
        $this->data['product']                = Product::where( 'code', $code )->first();
        $this->data['gallery']  = ProductGallery::where( 'product_id', $this->data['product']->id )->get();

        return view('frontend.profile.product.gallery', $this->data );
    }


    public function add_gallery(Request $request, $code)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($validator->fails()) 
        {
            echo json_encode( [ 'err' => $validator->errors()->first('file') ] );
            die();
        }
        $file = $request->file;
        $filename    = $file->getClientOriginalName();
        $img_name = time().'.'. \File::extension($filename);
        $path = public_path('storage/product/gallery');

        $this->resize_img_and_watermark($file, $img_name, $path);

        $product = Product::where('code', $code)->first();

        $options = [ 
            'product_id' => $product->id,
            'img' => $img_name,
            'path' => $path, 
        ];


        $img_id = $this->add_additional_image_info( $options, $product->id );

        

        if( $img_id > 0 )
        {
            $img_uploaded_info = [
                'id'            => $img_id,
                'img_path'      => asset('storage/product/gallery/361x230_'.$img_name),
                'delete_url'    => route('my-account.product.gallery.destroy', [$img_id]),
                'product_id'    => $product->id
            ];

            echo json_encode( [ 'success' => 'ture', 'img_data' => $img_uploaded_info ] );
        }
        else if ( $img_id == "limit exceeds" )
        {
            $this->remove_additional_image( $options );
            echo json_encode( [ 'err' => 'Image limit exceeded. You can add maximum 4 images.<br /> Please delete images from the Saved Images panel to save new one.' ] );
            die();
        }
        else
        {
            echo json_encode( [ 'err' => 'Could not save the image. Please try again' ] );
        }

    }

    private function add_additional_image_info( $upload_info, $product_id )
    {
        $images = ProductGallery::where('product_id', $product_id)->get();
        if($images->count() >= 4)
            return 'limit exceeds';

        $img_id = ProductGallery::create( $upload_info );
        return $img_id->id;
    }


    public function remove_additional_image( $img_data )
    {
        $img_path   = $img_data['path'].'/'.$img_data['img'];
        $thumb_path = $img_data['path'].'/80x80_'.$img_data['img'];
        $product_img = $img_data['path'].'/361x230_'.$img_data['img'];

        if( file_exists( $img_path ) && is_file( $img_path ) )
        {
            unlink( $img_path );
        }

        if( file_exists( $thumb_path ) && is_file( $thumb_path ) )
        {
            unlink( $thumb_path );
        }

        if( file_exists( $product_img ) && is_file( $product_img ) )
        {
            unlink( $product_img );
        }
    }


    public function resize_img_and_watermark($file, $img_name, $path)
    {
        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(750, 430);
        $image_resize->save($path.'/'.$img_name);

        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(80, 80);
        $image_resize->save($path.'/80x80_'.$img_name);


        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(361, 230);
        $image_resize->save($path.'/361x230_'.$img_name);

        $value = $path.'/'.$img_name;
        $img = Image::make($value);
        $img->insert(public_path('images/watermark/1.png'), 'center');
        $img->save($value);

        $value = $path.'/80x80_'.$img_name;
        $img = Image::make($value);
        $img->insert(public_path('images/watermark/1.png'), 'center');
        $img->save($value);


        $value = $path.'/361x230_'.$img_name;
        $img = Image::make($value);
        $img->insert(public_path('images/watermark/1.png'), 'center');
        $img->save($value);
    }
}
