<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   	public function index()
   	{
   		$this->data['approvedUsers']	= \App\User::where( 'approved_at', '!=',  '' )->count( 'id' );
   		$this->data['pendingApproval']	= \App\User::where( 'approved_at',  null )->where('user_type_id', 2)->count( 'id' );
         $this->data['activatedBuyers']   = \App\User::where( 'status', 1 )->where('user_type_id', 1)->count( 'id' );
   		$this->data['deactivatedBuyers'] 	= \App\User::where( 'status', 0 )->where('user_type_id', 1)->count( 'id' );

         $this->data['activatedVendors']   = \App\User::where( 'status', 1 )->where('user_type_id', 2)->count( 'id' );
         $this->data['deactivatedVendors']    = \App\User::where( 'status', 0 )->where('user_type_id', 2)->count( 'id' );
   		$this->data['buyers']			= \App\User::where( 'user_type_id', 1 )->count( 'id' );
   		$this->data['vendors'] 			= \App\User::where( 'user_type_id', 2 )->count( 'id' );

   		$this->data['pendingProducts']	= \App\Product::where( 'status_id', 1 )->count( 'id' );
   		$this->data['approvedProducts']	= \App\Product::where( 'status_id', 2 )->count( 'id' );
   		$this->data['rejectedProducts']	= \App\Product::where( 'status_id', 3 )->count( 'id' );

   		$this->data['pendingRequirements']	= \App\BuyerRequirement::where( 'status_id', 1 )->count( 'id' );
   		$this->data['approvedRequirements']	= \App\BuyerRequirement::where( 'status_id', 2 )->count( 'id' );
   		$this->data['rejectedRequirements']	= \App\BuyerRequirement::where( 'status_id', 3 )->count( 'id' );
   		// return $this->data;
   		return view( 'backend.dashboard', $this->data );
   	}
}
