<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\VendorDetail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        return view('frontend.login');
    }


    protected function authenticated(Request $request, $user)
    {
        if($user->user_type_id == '3') {
            return redirect()->intended('/admin/dashboard');
        }
        
        if($user->user_type_id == '1') {
            return redirect()->intended('dashboard');
        }
        
        if ($user->user_type_id == '2') 
        {
            $detail = VendorDetail::where('user_id', $user->id)->first();
            // return $detail;
            if ( !isset($detail->id) ) 
            {
                return redirect( route('profile.create') );
            }
        }
    }
}
