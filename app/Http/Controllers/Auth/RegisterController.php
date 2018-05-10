<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Mail\AccountVerificationMail;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'guest' );
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create( $request->all() );

        Mail::to( $user->email )->send( new AccountVerificationMail( $user->email_token ) );
        // event(new Registered($user = $this->create($request->all())));

        // // $this->guard()->login($user);
        // dispatch(new SendVerificationEmail($user));
        if( $request->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Registration  successful' ], 200 );
        }

        return view( 'verification' );
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }


    public function showRegistrationForm()
    {
        return view( 'frontend.register' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $lastUser = User::orderBy( 'id', 'DESC' )->first();

        $code = ( $lastUser ) ? $this->generate_user_code( $lastUser->code ) : 'u-0001';
        
        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'user_type_id'  => $data['user_type_id'],
            'code'          => $code,
            'status'        => 0,
            'email_token'   => base64_encode( time() . $data['email'] )
        ]);
    }


    public function verify($token)
    {
        $user = User::where( 'email_token', $token )->first();
        $user->verified = 1;
        if( $user->save() )
        {
            return view( 'emailconfirm', [ 'user' => $user ] );
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
