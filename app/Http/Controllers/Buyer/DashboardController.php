<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\BuyerRequirement;
use App\Review;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pendingRequirement']   = BuyerRequirement::where( [ 'user_id' => Auth::user()->id, 'status_id' => 1 ] )->count();
        $this->data['approvedRequirement']  = BuyerRequirement::where( [ 'user_id' => Auth::user()->id, 'status_id' => 2 ] )->count();
        $this->data['rejectedRequirement']  = BuyerRequirement::where( [ 'user_id' => Auth::user()->id, 'status_id' => 3 ] )->count();

        $this->data['pendingReviews']       = Review::where( [ 'user_id' => Auth::user()->id, 'status_id' => 1 ] )->count();
        $this->data['approvedReviews']      = Review::where( [ 'user_id' => Auth::user()->id, 'status_id' => 2 ] )->count();
        $this->data['rejectedReviews']      = Review::where( [ 'user_id' => Auth::user()->id, 'status_id' => 3 ] )->count();

        // return $this->data;

        return view( 'frontend.buyer.dashboard', $this->data );
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
