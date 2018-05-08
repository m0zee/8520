<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;

class SocialAuthController extends Controller
{
	/*======================
	// 		GOOGLE
	======================*/
    public function googleRedirect()
    {
    	return Socialite::driver( 'google' )->redirect();
    }

    public function googleHandle($value='')
    {
    	echo '<pre>FILE: ' . __FILE__ . '<br>LINE: ' . __LINE__ . '<br>';
    	print_r( 'google/handle' );
    	echo '</pre>'; die;
    }





	/*======================
	// 		GOOGLE
	======================*/
    public function fbRedirect()
    {
        return Socialite::driver( 'facebook' )->scopes( [ 'email' ] )->redirect();
    }


    public function fbHandle(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/');
    }
}
