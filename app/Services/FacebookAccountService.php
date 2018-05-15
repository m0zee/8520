<?php

namespace App\Services;
use App\SocialAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class FacebookAccountService
{
    public function createOrGetUser( ProviderUser $providerUser )
    {
        $account = SocialAccount::whereProvider( 'facebook' )->whereProviderUserId( $providerUser->getId() )->first();

        if( $account )
        {
            return $account->user;
        }
        else
        {
            $account = new SocialAccount([
                'provider_user_id'  => $providerUser->getId(),
                'provider'          => 'facebook'
            ]);

            $user = User::whereEmail( $providerUser->getEmail() )->first();

            if( !$user )
            {
                $lastUser = User::orderBy( 'id', 'DESC' )->first();
                $code = ( $lastUser ) ? $this->generate_user_code( $lastUser->code ) : 'u-0001';

                $user = User::create([
                    'email'         => $providerUser->getEmail(),
                    'name'          => $providerUser->getName(),
                    'password'      => md5(rand(1,10000)),
                    'user_type_id'  => 1,
                    'code'          => $code
                ]);
            }

            $account->user()->associate( $user );

            $account->save();

            return $user;
        }
    }


    public function generate_user_code( $code )
    {
        $code =  explode( '-', $code );

        $index  = $code[1] + 1;

        $length = strlen( $index );

        switch( $length )
        {
            case 1:
                $index = '000' . $index;
            break;
            
            case 2:
                $index = '00' . $index;
            break;

            case 3:
                $index = '0' . $index;
            break;
        }

        $code = 'u-'. $index;

        return $code;
    }
}