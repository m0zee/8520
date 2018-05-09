<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;
use \App\UserType;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $user_type )
    {
        $user_type  = UserType::where( 'name', $user_type )->first();
        
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
