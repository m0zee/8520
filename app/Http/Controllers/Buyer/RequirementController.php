<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateRequirementRequest;
use App\BuyerRequirement;
use App\Unit;
use App\Category;
use App\Country;
use Intervention\Image\ImageManagerStatic as Image;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['requirements'] = BuyerRequirement::with( 'status', 'unit' )->where( 'user_id', Auth::user()->id )->get();

        return view( 'frontend.buyer.requirement.index', $this->data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['units']      = Unit::pluck( 'name', 'id' ); 
        $this->data['categories'] = Category::pluck( 'name', 'id' );
        $this->data['country']    = Country::pluck( 'name', 'id' );

        return view( 'frontend.buyer.requirement.create', $this->data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateRequirementRequest $request )
    {
        $files = $request->img;
        // return $files;
        if( $files != '' ) 
        {
            $filename   = $files->getClientOriginalName();
            $imageName  = time() . '.' .  \File::extension( $filename );
            $path       = public_path( 'storage/requirement' );

            $this->resize_img_and_watermark( $files, $imageName, $path );
        }

        $lastRow    = BuyerRequirement::orderBy( 'id', 'DESC' )->first();
        $code       = ( $lastRow ) ? $this->generate_code( $lastRow->code ) : 'req-0001';

        $requirement = [
            'user_id'           => Auth::user()->id,
            'name'              => $request->name,
            'slug'              => $this->slugify( $request->name ),
            'code'              => $code,
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'country_id'        => $request->country_id,
            'state_id'          => $request->state_id,
            'city_id'           => $request->city_id,
            'img'               => ( isset( $imageName ) ) ? $imageName : '' ,
            'path'              => ( isset( $path ) ) ? $path : '',
            'status_id'         => 1
        ];
        
        BuyerRequirement::create( $requirement );

        return redirect( route( 'buyer.requirements' ) )->with( 'success', 'Requirement successfully added' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $units          = Unit::pluck( 'name', 'id' ); 
        $categories     = Category::pluck( 'name', 'id' );
        $country        = Country::pluck( 'name', 'id' );
        $requirement    = BuyerRequirement::where( 'code', $code )->first();

        // return $subCategories;
        return view( 'frontend.buyer.requirement.edit', compact( 'units', 'categories', 'subCategories', 'country', 'requirement' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( CreateRequirementRequest $request, $code )
    {
        $files = $request->img;
        
        if( $files != '' ) 
        {
            $oldRequirement = BuyerRequirement::where( 'code', $code )->first();
            $filename   = $files->getClientOriginalName();
            $imageName  = time() . '.' .  \File::extension( $filename );
            $path       = public_path( 'storage/requirement' );

            $this->resize_img_and_watermark( $files, $imageName, $path );
        }

        $requirement = [
            'name'              => $request->name,
            'slug'              => $this->slugify( $request->name ),
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'country_id'        => $request->country_id,
            'state_id'          => $request->state_id,
            'city_id'           => $request->city_id,
            'status_id'         => 1
        ];

        if( isset( $imageName ) )
        {
            $requirement['img']     = $imageName;
            $requirement['path']    = $path;
        }

        BuyerRequirement::where( 'code', $code )->update( $requirement );

        if( isset( $imageName ) )
        {
            if( file_exists( $oldRequirement->path . '/' .  $oldRequirement->img ) )
            {
                unlink( $oldRequirement->path . '/' .  $oldRequirement->img );
                unlink( $oldRequirement->path . '/80x80_' . $oldRequirement->img );
                unlink( $oldRequirement->path . '/361x230_' . $oldRequirement->img );
            }
        }

        return redirect( route( 'buyer.requirements' ) )->with( 'success', 'Requirement successfully updated' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }



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

        $code = 'req-'. $index;

        return $code;
    }


    public function resize_img_and_watermark( $file, $img_name, $path )
    {
        $image_resize = Image::make( $file->getRealPath() );              
        $image_resize->resize( 750, 430 );
        $image_resize->save( $path . '/' . $img_name );

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
