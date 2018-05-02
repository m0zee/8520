<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function store( Request $request )
    {
        $this->validateRequest( $request );

        $report = $this->save( $request );

        if( $request->ajax() )
        {
            return response( [ 'status' => 'success', 'message' => 'Message has been successfully sent to admin.', 'data' => $report ], 200 );
        }
    }

    private function validateRequest( $request )
    {
        $this->validate( $request, 
            [ 'message'             => 'required' ],
            [ 'message.required'    => 'Please type your message' ]
        );
    }

    private function save( $request )
    {
        $data = [
            'product_id'    => $request->product_id,
            'message'       => $request->message,
            'sender_id'     => Auth::user()->id
        ];

        return \App\Report::create( $data );
    }
}
