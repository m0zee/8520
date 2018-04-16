<?php

namespace App\Http\Controllers\MyAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Country;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('user.detail', 'status', 'currency', 'unit', 'sub_category.category')->where( 'status_id', 2 )->get();

        // $vendor = \App\User::with( ['reviews' => function( $query ) {
        //     $query->where( 'status_id', 2 )->with( 'user.detail' );
        // }], 'detail' )->where( [ 'code' => $vendor_code ] )->first();
        return view('frontend.profile.product.list')->withProducts($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $units = DB::table('units')->pluck('name', 'id');
        $currencies = DB::table('currencies')->pluck('name', 'id');
        return view('frontend.profile.product.create', compact('categories', 'countries', 'currencies', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            '__files.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_name' => 'required',
            'name' => 'required',
            'country_id' => 'required',
            'unit_id' => 'required',
            'max_supply' => 'required',
            'currency_id' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails())
        {
            return json_encode(['errors' => $validator->errors()]);
        }

        $files = $request->__files[0];
        $path = public_path('storage/product');
        $imageName = time().'.'.$files->getClientOriginalName();
        $files->move( $path, $imageName );
        
        $lastProduct = Product::orderBy( 'id', 'DESC' )->first();
        $code = ( $lastProduct ) ? $this->generate_code( $lastProduct->code ) : 'pr-0001';

        $data = [
            'name' => $request->name,
            'slug' => $this->slugify($request->name),
            'code' => $code,
            'description' => $request->description,
            'brand_name' => $request->brand_name,
            'sub_category_id' =>$request->sub_category_id,
            'category_id' =>$request->category_id,
            'country_id' => $request->country_id,
            'max_supply' => $request->max_supply,
            'unit_id' => $request->unit_id,
            'currency_id' => $request->currency_id,
            'price' => $request->price,
            'img_path' => $path,
            'img' => $imageName,
            'user_id' => Auth::user()->id,
            'status_id' => '2'
        ];

        Product::create($data);
        return json_encode(['success' => true]);
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
    public function edit($product_code)
    {
        $countries = Country::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $units = DB::table('units')->pluck('name', 'id');
        $currencies = DB::table('currencies')->pluck('name', 'id');

        $product  = Product::where('code', $product_code)->first();
        return view('frontend.profile.product.edit', compact('categories', 'countries', 'currencies', 'units', 'product'));
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
        $product  = Product::where('code', $product_code)->first();
        $validator = Validator::make(
            $request->all(), [
            '__files.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_name' => 'required',
            'name' => 'required',
            'country_id' => 'required',
            'unit_id' => 'required',
            'max_supply' => 'required',
            'currency_id' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails())
        {
            return json_encode(['errors' => $validator->errors()]);
        }

        $new_imageName = NULL ;

        $files = $request->__files[0];
        if ($files->getClientOriginalName() != NULL) 
        {
            $path = public_path('storage/product');
            $new_imageName = time().'.'.$files->getClientOriginalName();
            $files->move( $path, $new_imageName );
        }
        else
        {
            $path = $product->img_path;
            $old_imageName = $product->img;
        }

        
       

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'brand_name' => $request->brand_name,
            'sub_category_id' =>$request->sub_category_id,
            'category_id' =>$request->category_id,
            'country_id' => $request->country_id,
            'max_supply' => $request->max_supply,
            'unit_id' => $request->unit_id,
            'currency_id' => $request->currency_id,
            'price' => $request->price,
            'img_path' => $path,
            'img' => ($new_imageName != NULL ) ? $new_imageName : $old_imageName,
            'user_id' => Auth::user()->id,
            'status_id' => '2'
        ];

        Product::where('code', $product_code)->update($data);

        if ( $new_imageName != NULL ) 
        {
            unlink($path.'/'.$product->img);
        }
        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function generate_code( $code )
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



}
