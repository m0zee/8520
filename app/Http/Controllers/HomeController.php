<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Product;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactUsEmail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories']   = \App\Category::pluck( 'name', 'slug' );
        $this->data['products']     = Product::with( 'sub_category.category', 'user.detail', 'currency', 'unit' )->where( 'status_id', 2 )->orderBy( 'id', 'DESC' )->paginate( 12 );

        return view( 'frontend.index', $this->data )->with( 'blue_menu', true );
    }

    public function getContact()
    {
        $this->data['countries']  = \App\Country::pluck( 'name', 'id' );

        return view( 'frontend.contact', $this->data )->with( 'blue_menu', true );
    }

    public function send( ContactRequest $request )
    {
        $sender     = $request->email;
        $country    = \App\Country::where( 'id', $request->country_id )->first()->name;
        $state      = \App\State::where( 'id', $request->state_id )->first()->name;
        $city       = \App\City::where( 'id', $request->city_id )->first()->name;
        $message    = $request->message;

        Mail::to( 'support@pakmaterial.com' )->send( new ContactUsEmail( $sender, $country, $state, $city, $message ) );

        return redirect()->back()->with( 'success', 'Email has been successfully sent.' );
    }
}
