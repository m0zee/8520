<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $categories = Category::get();
        $products = Product::with('sub_category.category', 'user.detail', 'currency')->get();
        return view('frontend.product.index', compact('categories', 'products'))->with( 'blue_menu', true );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    public function get_by_category($category_slug)
    {
        $categories = Category::with('sub_category')->where('slug', $category_slug)->first();
        // // return $categories;
        // foreach ($categories->sub_category as $category) {
        //     return $category->name;
        // }
        $products = DB::table('products as p')
                    ->select
                    (
                        'p.*', 
                        'sc.name as sub_category_name', 'sc.slug as sub_category_slug', 
                        'c.name as category_name', 'c.slug as category_slug', 
                        'vd.company_name', 'vd.profile_path', 'vd.profile_img', 
                        'cur.name as currency'
                        , 'u.code as user_code'
                    )
                    ->join('sub_categories AS sc', 'sc.id', '=', 'p.sub_category_id')
                    ->join( 'categories as c', 'c.id', '=', 'sc.category_id' )
                    ->join( 'users as u', 'u.id', '=', 'p.user_id' )
                    ->join( 'vendor_details as vd', 'vd.user_id', '=', 'u.id' )
                    ->join( 'currencies as cur', 'cur.id', '=', 'p.currency_id' )
                    // ->join( 'units as un', 'un.id', '=', 'p.unit_id' )
                    ->where('c.slug', $category_slug)
                    ->get();

                    // return $products;
        return view('frontend.product.category_wise_products', compact('categories', 'products'))->with( 'blue_menu', true );

    }
}
