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

        return view( 'frontend.profile.dashboard', $this->data );
    }
}
