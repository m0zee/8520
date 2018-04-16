<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShortlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\User::find( Auth::user()->id );

        $this->data['shortListedProducts'] = $user->shortlistProducts()->with( 'user', 'category', 'sub_category' )->paginate( 10 );
        // return $this->data;
    	return view( 'frontend.buyer.shortlist.index', $this->data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \App\User::find( Auth::user()->id );
        $user->shortlistProducts()->attach( $request->product_id );

        return response( [ 'status' => 'success', 'message' => 'Product has been shortlisted successfully!' ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $user = \App\User::find( Auth::user()->id );
        $user->shortlistProducts()->detach( $id );

        if( request()->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Product has been successfully removed from shortlist!' ], 200 );
        }

        return redirect()->back()->with( 'success', 'Product has been successfully removed from shortlist!' );

    }
}
