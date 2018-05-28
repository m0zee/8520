<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status_type = NULL )
    {
        $this->query = \App\Review::where( 'user_id', Auth::user()->id )->with( 'vendor' )->orderBy( 'id', 'DESC' );

         if ( $status_type != NULL ) 
        {
            switch ($status_type) {
                case 'pending':
                    $status_id = 1;
                    break;

                case 'approved':
                    $status_id = 2;
                    break;
                
                case 'rejected':
                    $status_id = 3;
                    break;
            }
            $this->reviews = $this->query->where('status_id', $status_id )->paginate( 10 );
        }
        else
        {
            $this->reviews = $this->query->paginate( 10 );

        }



        $this->data['reviews'] = $this->reviews;

        // return $this->data;
        return view( 'frontend.buyer.review.index', $this->data );
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
    // public function store(Request $request)
    // {
    //     //
    // }

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
    // public function destroy($id)
    // {
    //     //
    // }
}
