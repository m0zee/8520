<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\VendorDetail;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function create()
    {
    	$country = Country::pluck( 'name', 'id' );
    	$user = Auth::user();

    	return view( 'frontend.profile.create', compact( 'country', 'user' ) );
    }





    public function store( Request $request )
    {
        $profile_img = [];
        $cover_img = [];
        if( $request->hasFile( 'profile_img' ) ) 
        {
            $this->validate( $request, [
                'profile_img' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $path = public_path( 'storage/profile_img' );
            $imageName = time() . '.' . $request->profile_img->getClientOriginalName();
            $request->profile_img->move( $path, $imageName );

            $profile_img = [
                'profile_img'   => $imageName,
                'profile_path'  => $path,
            ];
        }

        if( $request->hasFile( 'cover_img' ) ) 
        {
            $this->validate( $request, [
                'cover_img' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $path = public_path( 'storage/cover_img' );
            $imageName = time() . '.' . $request->cover_img->getClientOriginalName();
            $request->cover_img->move( $path, $imageName );

            $cover_img = [
                'cover_img'     => $imageName,
                'cover_path'    => $path,
            ];
        }

        $this->validate( $request, [
            'name'          => 'required',
            'company_name'  => 'required',
            'country_id'    => 'required',
            'state_id'      => 'required',
            'city_id'       => 'required',
            'address'       => 'required',
            'mobile_number' => 'required',
        ], [
            'name.required'             => 'Please enter Name',
            'company_name.required'     => 'Please enter Company Name',
            'country_id.required'       => 'Please select Country',
            'state_id.required'         => 'Please select State',
            'city_id.required'          => 'Please select City',
            'address.required.required' => 'Please enter Address',
            'mobile_number.required'    => 'Please enter Mobile Number',
        ]);

        $data = [
            'user_id'       => Auth::user()->id,
            'company_name'  => $request->input( 'company_name' ),
            'country_id'    => $request->input( 'country_id' ),
            'state_id'      => $request->input( 'state_id' ),
            'city_id'       => $request->input( 'city_id' ),
            'address'       => $request->input( 'address' ),
            'mobile_number' => $request->input( 'mobile_number' ),
            'phone_number'  => $request->input( 'phone_number' ),
            'cash'          => $request->input( 'cash' ),
            'cheque'        => $request->input( 'cheque' ),
            'card'          => $request->input( 'card' ),
            'description'   => $request->input( 'description' ),
            'facebook'      => $request->input( 'facebook' ),
            'twitter'       => $request->input( 'twitter' ),
            'google_plus'   => $request->input( 'google_plus' ),
            'linked_in'     => $request->input( 'linked_in' ),
        ];

        $options = array_merge($data, $profile_img, $cover_img);
    	VendorDetail::create($options);
        User::find(Auth::user()->id)->update(['name' => $request->name]);
        return redirect( route( 'profile.create' ) )->with( 'success', 'Profile has been updated successfully' );
    }


    public function edit($code)
    {
        $country    = Country::pluck( 'name', 'id' );
        $user       = User::with( 'detail' )->where( 'code', $code )->first();

        return view( 'frontend.profile.edit', compact( 'country', 'user' ) );
    }



    public function update(Request $request, $code)
    {
        $profile_img    = [];
        $cover_img      = [];

        if( $request->hasFile( 'profile_img' ) ) 
        {
            $this->validate($request, [
                'profile_img' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $path       = public_path( 'storage/profile_img' );
            $imageName  = time() . '.' . $request->profile_img->getClientOriginalName();

            $request->profile_img->move( $path, $imageName );

            $profile_img = [
                'profile_img'   => $imageName,
                'profile_path'  => $path,
            ];
        }

        if( $request->hasFile( 'cover_img' ) ) 
        {
            $this->validate( $request, [
                'cover_img' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $path       = public_path( 'storage/cover_img' );
            $imageName  = time() . '.' . $request->cover_img->getClientOriginalName();
            $request->cover_img->move( $path, $imageName );

            $cover_img = [
                'cover_img'     => $imageName,
                'cover_path'    => $path,
            ];
        }

        $this->validate( $request, [
            'name'          => 'required',
            'company_name'  => 'required',
            'country_id'    => 'required',
            'state_id'      => 'required',
            'city_id'       => 'required',
            'address'       => 'required',
            'mobile_number' => 'required',
        ]);

        $data = [
            'user_id'       => Auth::user()->id,
            'company_name'  => $request->input( 'company_name' ),
            'country_id'    => $request->input( 'country_id' ),
            'state_id'      => $request->input( 'state_id' ),
            'city_id'       => $request->input( 'city_id' ),
            'address'       => $request->input( 'address' ),
            'mobile_number' => $request->input( 'mobile_number' ),
            'phone_number'  => $request->input( 'phone_number' ),
            'cash'          => $request->input( 'cash' ),
            'cheque'        => $request->input( 'cheque' ),
            'card'          => $request->input( 'card' ),
            'description'   => $request->input( 'description' ),
            'facebook'      => $request->input( 'facebook' ),
            'twitter'       => $request->input( 'twitter' ),
            'google_plus'   => $request->input( 'google_plus' ),
            'linked_in'     => $request->input( 'linked_in' ),
        ];

        $options = array_merge( $data, $profile_img, $cover_img );
        
        VendorDetail::where( 'user_id', Auth::user()->id )->update( $options );
        
        User::find( Auth::user()->id )->update( [ 'name' => $request->name ] );
        
        return redirect( route( 'profile.edit', [ Auth::user()->code ] ) )->with( 'success', 'Profile has been updated successfully' );
    }





    public function show( $code )
    {
        $user = User::with( 'detail' )->where( 'code', $code )->first();
        
        if( ! $user )
        {
            return redirect( route( 'profile.create' ) )->with( 'error', 'User not found!' );
        }

        $this->data['user'] = $user;

        return view( 'frontend.profile.show', $this->data );
    }
}
