<?php

namespace App\Http\Controllers\MyAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $this->data['pendingProducts']  = \App\Product::where( [ 'status_id' => 1, 'user_id' => $user_id ] )->count( 'id' );
        $this->data['approvedProducts'] = \App\Product::where( [ 'status_id' => 2, 'user_id' => $user_id ] )->count( 'id' );
        $this->data['rejectedProducts'] = \App\Product::where( [ 'status_id' => 3, 'user_id' => $user_id ] )->count( 'id' );

        // $this->data['pendingRequirements']  = \App\BuyerRequirement::where( 'status_id', 1 )->count( 'id' );
        // $this->data['approvedRequirements'] = \App\BuyerRequirement::where( 'status_id', 2 )->count( 'id' );
        // $this->data['rejectedRequirements'] = \App\BuyerRequirement::where( 'status_id', 3 )->count( 'id' );
        return view( 'frontend.profile.dashboard', $this->data );
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
