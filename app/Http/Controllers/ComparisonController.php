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
        if( session()->exists( 'comparisonList' ) )
        {
            $list = session( 'comparisonList' );

            if( ! array_key_exists( $request->product_id, $list ) )
            {
                $list[ $request->product_id ] = Product::with( 'user' )->where( 'id', $request->product_id )->first();

                session( [ 'comparisonList' => $list ] );
            }
        }
        else
        {
            $product = Product::with( 'user' )->where( 'id', $request->product_id )->first();

            session( [ 'comparisonList' => [ $request->product_id => $product ] ] );
        }

        return response( [ 'status' => 'success', 'message' => 'Product has been added to comparison list.' ], 200 );
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
            session()->pull( 'comparisonList.' . $id );
        }

        if( request()->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Product has been successfully removed from comparison list.' ], 200 );
        }

        return redirect()->back()->with( 'success', 'Product has been successfully removed from comparison list.' );
    }
}
