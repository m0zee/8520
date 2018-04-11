<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Http\Requests\VendorReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'CheckLogin', [ 'only' => [ 'store' ] ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $vendor_code )
    {
        $vendor = \App\User::with( ['reviews' => function( $query ) {
            $query->where( 'status_id', 2 )->with( 'user.detail' );
        }], 'detail' )->where( [ 'code' => $vendor_code ] )->first();
        
        
        return view( 'review.index', compact( 'vendor' ) );
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
    public function store( VendorReviewRequest $request, $vendor_code )
    {
        $user_id = Auth::user()->id;
        // \Illuminate\Support\Facades\DB::enableQueryLog();
        $row = Review::where( [ 'user_id' => $user_id, 'vendor_code' => $vendor_code ] )->first();
        // return \Illuminate\Support\Facades\DB::getQueryLog();
        if( $row )
        {
            return redirect()->back()->with( 'error', 'You have already reviewd this vendor.' );
        }

        $review = [
            'ratings'       => $request->ratings,
            'review'        => $request->review,
            'status_id'     => 1,
            'user_id'       => $user_id,
            'vendor_code'   => $vendor_code
        ];

        $review = Review::create( $review );
        
        return redirect()->back()->with( 'success', 'Your reveiw has been saved and sent to the admin for approval. You can check the status of your review in -------- section.' );
    }

    // public function ratings(Request $request, $vendor_code )
    // {
    //     $user_id = Auth::user()->id;
    //     // \Illuminate\Support\Facades\DB::enableQueryLog();
    //     $review = Review::where( [ 'user_id' => $user_id, 'vendor_code' => $vendor_code ] )->first();

    //     if( ! $review )
    //     {
    //         // $review->
    //     }
    //     return $review;
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
