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

     public function fbHandle( FacebookAccountService $service )
    {
        $user = $service->createOrGetUser( Socialite::driver( 'facebook' )->user() );

        auth()->login( $user );

        return redirect()->to('/');
    }
}
