<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\Http\Requests\VendorReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $vendor_code )
    {
        // \Illuminate\Support\Facades\DB::enableQueryLog();
        $vendor = \App\User::with( 'reviews.user.detail' )->with( 'detail')->where( 'code', $vendor_code )->first();

        // return $vendor;
        // return \Illuminate\Support\Facades\DB::getQueryLog();
        // $this->data['vendor'] = $vendor;
        
        return view( 'review.index', compact( 'vendor' ) );
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
    public function store( VendorReviewRequest $request )
    {
        $review = [
            'ratings'       => 0,
            'review'        => $request->review,
            'status_id'     => 1,
            'user_id'       => Auth::user()->id,
            'vendor_code'   => ''
        ];

        echo '<pre>FILE: ' . __FILE__ . '<br>LINE: ' . __LINE__ . '<br>';
        print_r( $review );
        echo '</pre>'; die;
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
}
