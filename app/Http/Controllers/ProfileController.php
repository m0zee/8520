<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;

class ProfileController extends Controller
{
    public function create()
    {
    	$country = Country::pluck('name', 'id');
    	$user = \Auth::user();
    	return view('frontend.profile.create', compact('country', 'user') );
    }
}
