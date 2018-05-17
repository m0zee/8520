<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['reviews'] = Review::with( 'vendor', 'user', 'status' )->orderBy( 'id', 'DESC' )->paginate( 10 );
        // return $this->data['reviews'];
        return view( 'backend.review.index', $this->data );
    }





    public function approve( $review_id )
    {
        Review::where( 'id', $review_id )->update( [ 'status_id' => 2 ] );

        return redirect()->back()->with( 'success', 'Review has been successfully approved!' );
    }





    public function reject( $review_id )
    {
        Review::where( 'id', $review_id )->update( [ 'status_id' => 3 ] );

        return redirect()->back()->with( 'success', 'Review rejected.' );
    }
}
