<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\FacebookAccountService;
use App\Services\GoogleAccountService;

class SocialAuthController extends Controller
{
	/*======================
	// 		GOOGLE
	======================*/
    public function googleRedirect()
    {
    	return Socialite::driver( 'google' )->redirect();
    }

    public function googleHandle( GoogleAccountService $service )
    {
    	$user = $service->createOrGetUser( Socialite::driver( 'google' )->user() );

        auth()->login( $user );

        return redirect()->to( '/' );
    }





	/*======================
	// 		GOOGLE
	======================*/
    public function fbRedirect()
    {
        return Socialite::driver( 'facebook' )->scopes( [ 'email' ] )->redirect();
    }

     public function fbHandle( FacebookAccountService $service, Request $request )
    {
        if ( $request->has('error') ) 
        {
            return redirect('/login')->with('error', $request->error_description );
        }
        $user_data =  Socialite::driver( 'facebook' )->user();
        $email = $user_data->getEmail();

        if ( $email == NULL ) 
        {
            return redirect('/login')->with('error', 'Email address is required.');
        }

        $user = $service->createOrGetUser( $user_data );

        auth()->login( $user );

        return redirect()->to('/');
    }

    // public function fbHandle( FacebookAccountService $service, Request $request )
    // {
    //     if ( $request->has('error') ) 
    //     {
    //         return redirect('/login')->with('error', $request->error_description );
    //     }
    //     $user_data = Socialite::driver( 'facebook' )->user();
    //     $email = $user_data->getEmail();

    //     if ( $email == NULL ) 
    //     {
    //         return redirect('/login')->with('error', 'Email address is required.');
    //     }
    //     $user = $service->createOrGetUser( Socialite::driver( 'facebook' )->user() );

    //     auth()->login( $user );

    //     return redirect()->to('/');
    // }
}
