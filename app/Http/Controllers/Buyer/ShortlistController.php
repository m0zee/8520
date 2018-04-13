<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShortlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return '<h1>Implement the ShortList Functionality</h1>';
        // $this->data['reviews'] = \App\Review::where( 'user_id', Auth::user()->id )->with( 'vendor' )->orderBy( 'id', 'DESC' )->paginate( 10 );
        // // return $this->data;
        // return view( 'frontend.buyer.review.index', $this->data );
    }
}
