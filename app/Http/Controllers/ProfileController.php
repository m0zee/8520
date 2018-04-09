<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\VendorDetail;

class ProfileController extends Controller
{
    public function create()
    {
    	$country = Country::pluck('name', 'id');
    	$user = \Auth::user();
    	return view('frontend.profile.create', compact('country', 'user') );
    }


    public function store(Request $request)
    {
    	VendorDetail::create([
    		'user_id' => \Auth::user()->id,
            'company_name' => $request->input('company_name') ,
            'country_id' => $request->input('country_id') ,
            'state_id' => $request->input('state_id') ,
            'city_id' => $request->input('city_id') ,
            'address' => $request->input('address') ,
            'mobile_number' => $request->input('mobile_number') ,
            'phone_number' => $request->input('phone_number') ,
            'cash' => $request->input('cash') ,
            'cheque' => $request->input('cheque') ,
            'card' => $request->input('card') ,
        ]);

        return redirect('vendor.profile');
    }
}
