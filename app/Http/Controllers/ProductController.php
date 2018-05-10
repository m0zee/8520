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
        $this->data['categories'] = Category::get();
        $this->data['products']   = Product::with( 'sub_category.category', 'user.detail', 'currency' )->orderBy('id', 'DESC')->paginate( 12 );
        
        return view( 'frontend.product.index', $this->data )->with( 'blue_menu', true );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $category, $sub_category, $code, $slug )
    {
        $this->data['product'] = Product::where( 'code', $code )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail', 'country', 'gallery' )->first();
        $this->data['relativeProducts'] = Product::where( 'code', '!=', $code )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail' )->take( 3 )->get();
// return $this->data['product']->user->detail->company_name;
        return view( 'frontend.product.show', $this->data );
    }





    public function search( Request $request )
    {
        $category   = Category::where( 'slug', $request->category )->first();

        $_query     = Product::with( 'sub_category.category', 'user.detail', 'currency', 'unit' )->where( 'status_id', 2 )
        ->where( 'name', 'like', '%' . $request->get( 'query' ) . '%' )->orderBy( 'id', 'DESC' );

        if( $category != null )
        {
            $_query->where( 'category_id', $category->id );

            $this->data['categories']   = Category::with( 'sub_category' )->where( 'slug', $request->category )->first();

            $views = 'frontend.product.category_wise_products';
        }
        else
        {
            $this->data['categories'] = Category::get();

            $views = 'frontend.product.index';
        }

        $this->data['products']     = $_query->paginate( 12 );

        return view( $views, $this->data )->with( 'blue_menu', true );
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





    public function get_by_category( $category_slug )
    {

        $category = Category::with( 'sub_category' )->where( 'slug', $category_slug )->first();
        
        $this->data['products'] = Product::with( 'sub_category.category', 'user.detail', 'currency', 'unit' )->where( 'status_id', 2 )
        ->where( 'category_id', $category->id )->orderBy( 'id', 'DESC' )->paginate( 12 );

        $this->data['categories'] = $category;

        return view( 'frontend.product.category_wise_products', $this->data )->with( 'blue_menu', true );
    }





    public function get_by_sub_category( $category_slug, $sub_category_slug )
    {
        $this->data['sub_category_products'] = SubCategory::where( 'slug', $sub_category_slug )->with( 'product.user.detail', 'product.currency' )->first();

        return view( 'frontend.product.sub_category_wise_products', $this->data )->with( 'blue_menu', true );
    }
}
