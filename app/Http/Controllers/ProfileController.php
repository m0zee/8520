<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\VendorDetail;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Intervention\Image\ImageManagerStatic as Image;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'IsProfileCreated', [ 'only' => [ 'update', 'edit' ] ] );
    }




    public function create()
    {
    	$country   = Country::pluck( 'name', 'id' );
    	$user      = Auth::user();

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
            'description'   => $request->input( 'description' )
        ];

        $options = array_merge($data, $profile_img, $cover_img);
    	VendorDetail::create($options);
        User::find(Auth::user()->id)->update(['name' => $request->name]);
        return redirect( route( 'profile.create' ) )->with( 'success', 'Profile has been updated successfully' );
    }


    public function edit( $code )
    {
        $userCode = Auth::user()->code;
        if( $code !== $userCode )
        {
            return redirect( route( 'profile.edit', [ $userCode ] ) );
        }

        $country    = Country::pluck( 'name', 'id' );
        $user       = User::with( 'detail' )->where( 'code', $code )->first();
        
        return view( 'frontend.profile.edit', compact( 'country', 'user' ) );
    }



    public function update(Request $request, $code)
    {
        $profile_img    = [];
        $cover_img      = [];

        $this->validate( $request, [
            'name'          => 'required',
            'company_name'  => 'required',
            'country_id'    => 'required',
            'state_id'      => 'required',
            'city_id'       => 'required',
            'address'       => 'required',
            'mobile_number' => 'required',
            'cover_img' => 'mimes:jpeg,png,jpg|max:2048',
            'profile_img' => 'mimes:jpeg,png,jpg|max:2048'
        ]);

        $old_imageName = NULL;
        if( $request->hasFile( 'profile_img' ) ) 
        {
            $files     = $request->profile_img;
            $filename  = $files->getClientOriginalName();
            $imageName = time().'.'. \File::extension($filename);
            $path      = public_path( 'storage/profile_img' );

            $this->resize_profile_img($files, $imageName, $path);

            $profile_img = [
                'profile_img'   => $imageName,
                'profile_path'  => $path,
            ];

            $old_imageName  = Auth::user()->detail->profile_img;
            $old_path       = $path; 
        }

        if( $request->hasFile( 'cover_img' ) ) 
        {
            $path       = public_path( 'storage/cover_img' );
            $imageName  = time() . '.' . $request->cover_img->getClientOriginalName();
            $request->cover_img->move( $path, $imageName );

            $cover_img = [
                'cover_img'     => $imageName,
                'cover_path'    => $path,
            ];
        }


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
            'description'   => $request->input( 'description' )
        ];

        $options = array_merge( $data, $profile_img, $cover_img );
        
        VendorDetail::where( 'user_id', Auth::user()->id )->update( $options );
        
        User::find( Auth::user()->id )->update( [ 'name' => $request->name ] );
        if ( $old_imageName != NULL ) 
        {
            unlink($path.'/'. $old_imageName);
            unlink($path.'/30x30_'.$old_imageName);
            unlink($path.'/50x50_'. $old_imageName);
        }
        
        return redirect( route( 'profile.edit', [ Auth::user()->code ] ) )->with( 'success', 'Profile has been updated successfully' );
    }





    public function show( $code )
    {
        $this->data['user']         = User::with( 'detail' )->where( 'code', $code )->first();
        $this->data['productCount'] = Product::where( [ 'user_id' => $this->data['user']->id, 'status_id' => 2 ] )->count();
        $this->data['products']     = Product::with( 'user.detail', 'status', 'currency', 'unit', 'sub_category.category' )->where([ 
            'user_id'   => $this->data['user']->id,
            'status_id' => 2
        ])->take( 4 )->get();

        return view( 'frontend.profile.show', $this->data );
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
}
