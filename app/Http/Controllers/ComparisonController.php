<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['list'] = '';
        if( session()->has( 'comparisonList' ) )
        {
            $this->data['list'] = session( 'comparisonList' );
        }

        // return $this->data['list'];

        return view( 'frontend.comparison.index', $this->data )->with( 'blue_menu', true );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $count = ( session()->exists( 'productCount' ) ) ? session( 'productCount' ) : 0 ;


        if( session()->exists( 'comparisonList' ) )
        {
            $list   = session( 'comparisonList' );
            $count  = count( $list );

            if( ! array_key_exists( $request->product_id, $list ) )
            {
                $list[ $request->product_id ] = Product::with( 'user', 'currency', 'country', 'unit', 'sub_category', 'category' )->where( 'id', $request->product_id )->first();

                $count = count( $list );

                // return $list;

                session( [ 'comparisonList' => $list, 'productCount' => $count ] );
                
            }
        }
        else
        {
            $list[ $request->product_id ] = Product::with( 'user', 'currency', 'country', 'unit', 'sub_category', 'category' )->where( 'id', $request->product_id )->first();
            
            session( [ 'comparisonList' => $list, 'productCount' => $count = count( $list ) ] );
        }

        return response( [ 'status' => 'success', 'message' => 'Product has been added to comparison list.', 'productCount' => $count ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( session()->has( 'comparisonList' ) )
        {
            $list = session( 'comparisonList' );
            if( array_key_exists( $id, $list ) )
            {
                unset( $list[$id] );
                
                session( [ 'comparisonList' => $list, 'productCount' => $count = count( $list ) ] );
            }
        }

        if( request()->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Product has been successfully removed from comparison list.' ], 200 );
        }

        return redirect()->back()->with( 'success', 'Product has been successfully removed from comparison list.' );
    }
}
