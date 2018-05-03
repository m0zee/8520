<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type_id = Auth::user()->user_type_id;
      
        $this->data['user_type_id'] = $user_type_id;

        if( $user_type_id == 3 )
        {
            return view( 'backend.changePassword.index', $this->data );
        }
        else if( $user_type_id == 2 || $user_type_id == 1 )
        {
            return view( 'frontend.changePassword.index', $this->data );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validateRequest( $request );
        
        $user = \App\User::where( 'id', Auth::user()->id )->first();
        
        if( Hash::check( $request->currentPassword, $user->password ) == false )
        {
            return redirect()->back()->with( 'error', 'Current Password is invalid.' );
        }

        $user->password = bcrypt( $request->newPassword );
        $user->save();

        return redirect()->back()->with( 'success', 'Password has been successfully changed.' );
    }

    private function validateRequest( $request )
    {
        $rules = [
            'currentPassword'   => 'required',
            'newPassword'       => 'required',
            'confirmPassword'   => 'required|same:newPassword'
        ];

        $messages = [
            'currentPassword.required'  => 'Please enter Current Password',
            'newPassword.required'      => 'Please enter New Password',
            'confirmPassword.required'  => 'Please enter Confirm Password',
            'confirmPassword.same'      => 'New Password and Confirm Password do not match'
        ];

        $this->validate( $request, $rules, $messages );
    }
}
