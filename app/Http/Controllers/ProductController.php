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
        $this->data['products']   = Product::with( 'sub_category.category', 'user.detail', 'currency' )->orderBy('id', 'DESC')
                                    ->where('status_id', 2)->paginate( 12 );
        
        return view( 'frontend.product.index', $this->data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $category, $sub_category, $code, $slug )
    {
        $product = Product::where( 'code', $code )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail', 'country', 'gallery' )->first();
        $this->data['product'] = $product;
        $this->data['relativeProducts'] = Product::where( 'code', '!=', $code )->where('sub_category_id', $this->data['product']->sub_category->id )->with( 'category', 'sub_category', 'currency', 'unit', 'user.detail' )->take( 3 )->get();

        $this->getRatings( $product->user->code );

        return view( 'frontend.product.show', $this->data );
    }

    private function getRatings( $user_code )
    {
        $ratings = \App\Review::select([
            DB::raw( 'SUM( ratings ) AS stars' ), DB::raw( 'COUNT( id ) AS raters' )
        ])->where( [ 'vendor_code' =>  $user_code, 'status_id' => 2 ] )->first();

        $this->data['raters']       = $ratings->raters;
        $this->data['avgRatings']   = ( $ratings->stars != null ) ? round( (int)$ratings->stars / (int)$ratings->raters ) : 0;
    }





    public function search( Request $request )
    {
        $category   = Category::where( 'slug', $request->category )->first();
        $category_id = ( $category == NULL ) ? 0 : $category->id; 

        $rows = Product::search( $request->get( 'query' ), $category_id );

        if( $category != null )
        {
            $this->data['categories']   = Category::with( 'sub_category' )->where( 'slug', $request->category )->first();

            $views = 'frontend.product.search.category_wise_products';
        }
        else
        {
            $this->data['categories'] = Category::get();

            $views = 'frontend.product.search.index';
        }

        $this->data['products']     = $rows;

        return view( $views, $this->data );
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

        $this->data['products'] =   Product::with( 'sub_category', 'user.detail', 'currency', 'unit' )
                                    ->where( [ 'status_id' => 2, 'category_id' => $category->id ] )
                                    ->orderBy( 'id', 'DESC' )->paginate( 12 );

        $this->data['categories'] = $category;

        return view( 'frontend.product.category_wise_products', $this->data );
    }





    public function get_by_sub_category( $category_slug, $sub_category_slug )
    {
        $sub_category = SubCategory::where( 'slug', $sub_category_slug )->first();

        $this->data['products'] =   Product::where( 'sub_category_id', $sub_category->id )
                                    ->where( 'status_id', 2 )->with( 'sub_category', 'user.detail', 'currency', 'unit' )
                                    ->paginate( 12 );

        $this->data['sub_category'] = $sub_category;
        return view( 'frontend.product.sub_category_wise_products', $this->data );
    }
}
