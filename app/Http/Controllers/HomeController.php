<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products   = Product::with( 'sub_category.category', 'user.detail', 'currency' )->where('status_id', 2)->orderBy('id', 'DESC')->paginate( 12 );
        return view('frontend.index' ,compact( 'products' ) )->with('blue_menu', true);
    }


}
