<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;
use \App\UserType;
use \App\VendorDetail;
use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Mail\AccountVerificationMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_type)
    {
        $user_type  = UserType::where('name', $user_type)->first();

        $user       = $user_type->user;
        
        return view( 'backend.users.index' )->with( 'users', $user )->with( 'user_type', $user_type );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country    = Country::pluck( 'name', 'id' );
        return view('backend.users.create', compact('country') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
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

        $lastUser = User::orderBy( 'id', 'DESC' )->first();

        $code = ( $lastUser ) ? $this->generate_user_code( $lastUser->code ) : 'u-0001';

        $user = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'user_type_id'  => 2,
            'code'          => $code,
            'status'        => 1,
            'email_token'   => base64_encode( time() . $request->email )
        ];

        $VendorDetail = [
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
            'description'   => $request->input( 'description' )
        ];

        $user = User::create($user);


        $id =  [ 'user_id'     => $user->id ];
        
        $options = array_merge( $VendorDetail, $profile_img, $cover_img, $id );
        VendorDetail::create( $options );
        Mail::to( $user->email )->send( new AccountVerificationMail( $user->email_token ) );
        return redirect( route( 'admin.userlist', ['vendor'] ) )->with( 'success', 'Vendor Successfully Created' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function approve($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if ( $user->approved_by == null ) {
            User::where('id', $user_id)
            ->update([
                'approved_by' => Auth::user()->id ,
                'approved_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect(route('admin.userlist', ['vendor']));
    }


    public function statusUpdate($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $new_status = ($user->status == 1) ? 0 : 1 ;
        User::where('id', $user_id)
            ->update([
                'status' => $new_status,
            ]);
        return redirect(route('admin.userlist', [$user->user_type->name]));
    }


    public function productLimit(Request $request)
    {
        $limit = $request->value;
        $data = [
            'product_limit' => $limit
        ];
        User::where( 'id', $request->pk )->update($data);
        return $limit;
    }


    public function resize_profile_img($file, $img_name, $path)
    {
        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(30, 30);
        $image_resize->save($path.'/30x30_'.$img_name);

        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(50, 50);
        $image_resize->save($path.'/50x50_'.$img_name);

        $image_resize = Image::make($file->getRealPath());              
        $image_resize->resize(100, 100);
        $image_resize->save($path.'/'.$img_name);
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
