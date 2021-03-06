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
        $this->middleware( 'guest' )->except( 'logout' );
    }


    public function showLoginForm()
    {
        return view( 'frontend.login' );
    }


    protected function authenticated(Request $request, $user)
    {
        if( $request->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Logged in successfully' ], 200 );
        }

        switch( $user->user_type_id )
        {
            case '3':
                return redirect()->intended( 'admin/dashboard' );
            break;

            case '2':
                $detail = VendorDetail::where( 'user_id', $user->id )->first();
                // return $detail;
                if( ! isset( $detail->id ) ) 
                {
                    return redirect( route( 'profile.create' ) );
                }
                else 
                    return redirect( route('my-account.product.create') );
            break;

            case '1':
                return redirect()->intended( 'buyer/dashboard' );
            break;
            
            default:
                # code...
            break;
        }
    }
}
