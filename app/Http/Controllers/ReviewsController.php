<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\VendorReviewRequest;
use App\User;
use App\Review;
use App\Product;

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
        $user                       = User::where( [ 'code' => $vendor_code ] )->first();
        $this->data['vendor']       = $user;
        $this->data['reviews']      = Review::where( [ 'status_id' => 2, 'vendor_code' => $vendor_code ] )->with( 'user.detail' )->paginate( 10 );
        $this->data['productCount'] = Product::where( [ 'user_id' => $user->id, 'status_id' => 2 ] )->count();

        $this->getRatings( $vendor_code );

        return view( 'review.index', $this->data );
    }

    private function getRatings( $user_code )
    {
        $ratings = Review::select([
            DB::raw( 'SUM( ratings ) AS stars' ), DB::raw( 'COUNT( id ) AS raters' )
        ])->where( [ 'vendor_code' =>  $user_code, 'status_id' => 2 ] )->first();

        $this->data['raters']       = $ratings->raters;
        $this->data['avgRatings']   = ( $ratings->stars != null ) ? round( (int)$ratings->stars / (int)$ratings->raters ) : 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( VendorReviewRequest $request, $vendor_code )
    {
        $user_id = Auth::user()->id;
        
        $row = Review::where( [ 'user_id' => $user_id, 'vendor_code' => $vendor_code ] )->first();

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
        
        return redirect()->back()->with( 'success', 'Your reveiw has been saved and sent to the admin for approval. You can check the status of your review in review section.' );
    }
}
