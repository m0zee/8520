<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Country;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware( [ 'CheckLogin' ] )->only( 'shortlist' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $products   = Product::with( 'sub_category.category', 'user.detail', 'currency' )->orderBy('id', 'DESC')->paginate( 12 );
        
        return view( 'frontend.product.index', compact( 'categories', 'products' ) )->with( 'blue_menu', true );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $sub_category, $code, $slug)
    {
         //return '<h1><center>Implement the functionality</center></h1>';
        $product = Product::where('code', $code)->with('category', 'sub_category', 'currency', 'unit', 'user.detail', 'country', 'gallery')->first();
        
        return view('frontend.product.show', compact('product'));
    }

    public function get( $id )
    {
        $product = Product::with( 'unit' )->find( $id );
        
        $return = [
            'id'        => $product->id,
            'code'      => $product->code,
            'name'      => $product->name,
            'unit'      => $product->unit->name,
            'user_id'   => $product->user_id,
        ];

        return response( [ 'status' => 'success', 'product' => $return ], 200 );
    }


    public function get_by_category($category_slug)
    {
        $categories = Category::with( 'sub_category' )->where( 'slug', $category_slug )->first();
        $products = DB::table('products as p')->select(
            'p.*', 
            'sc.name as sub_category_name', 'sc.slug as sub_category_slug', 
            'c.name as category_name', 'c.slug as category_slug', 
            'vd.company_name', 'vd.profile_path', 'vd.profile_img', 
            'cur.name as currency',
            'u.code as user_code',
            'un.name as unit_name'
        )
        ->join('sub_categories AS sc',  'sc.id',        '=', 'p.sub_category_id' )
        ->join( 'categories as c',      'c.id',         '=', 'sc.category_id' )
        ->join( 'users as u',           'u.id',         '=', 'p.user_id' )
        ->join( 'vendor_details as vd', 'vd.user_id',   '=', 'u.id' )
        ->join( 'currencies as cur',    'cur.id',       '=', 'p.currency_id' )
        ->join( 'units as un',    'un.id',       '=', 'p.unit_id' )
        ->where( 'c.slug', $category_slug )
        ->where('p.status_id', 2)
        ->get();

        return view( 'frontend.product.category_wise_products', compact( 'categories', 'products' ) )->with( 'blue_menu', true );
    }


    public function get_by_sub_category($category_slug, $sub_category_slug)
    {
        $sub_category_products = SubCategory::where( 'slug', $sub_category_slug )->with( 'product.user.detail', 'product.currency' )->first();
        // return $sub_category_products;
        return view( 'frontend.product.sub_category_wise_products', compact( 'sub_category_products' ) )->with( 'blue_menu', true );
    }
}
