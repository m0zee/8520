<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
}
