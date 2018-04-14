<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShortlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = \App\User::find( Auth::user()->id );

        $this->data['shortListedProducts'] = $user->shortlistProducts()->with( 'user' )->paginate( 10 );
        // return $this->data;
    	return view( 'frontend.buyer.shortlist.index', $this->data );
    }
}
