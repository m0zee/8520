<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   	public function index()
   	{
   		$this->data['items'] = \App\Product::where( 'status_id', 2 )->count( 'id' );
   		$this->data['users'] = \App\User::where( 'status', 1 )->count( 'id' );
   		// return $this->data;
   		return view( 'backend.dashboard', $this->data );
   	}
}
