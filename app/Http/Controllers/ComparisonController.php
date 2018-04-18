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

        return view( 'frontend.comparison.index', $this->data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $count = session( 'productCount' );
        // return $count;
        if( session()->exists( 'comparisonList' ) )
        {
            $list   = session( 'comparisonList' );
            $count  = count( $list );

            if( ! array_key_exists( $request->product_id, $list ) )
            {
                $list[ $request->product_id ] = Product::with( 'user', 'currency', 'country', 'unit' )->where( 'id', $request->product_id )->first();

                $count = count( $list );

                session( [ 'comparisonList' => $list, 'productCount' => $count ] );
            }
        }
        else
        {
            $list[ $request->product_id ] = Product::with( 'user', 'currency', 'country', 'unit' )->where( 'id', $request->product_id )->first();
            
            session( [ 'comparisonList' => $list, 'productCount' => $count = count( $list ) ] );
        }

        return response( [ 'status' => 'success', 'message' => 'Product has been added to comparison list.', 'productCount' => $count ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

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
