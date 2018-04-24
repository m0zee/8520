<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\MessageDetail;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['user_id']          = Auth::user()->id;
        $this->data['conversations']    = Message::getMessages( $this->data['user_id'] ); 

        // $this->data['conversations'] = Message::where( 'sender_id', $user_id )->orWhere( 'receiver_id', $user_id )->get();
       
        // \Illuminate\Support\Facades\DB::enableQueryLog();
        // $this->data['conversations'] = Message::getMessages( Auth::user()->id );
        // return \Illuminate\Support\Facades\DB::getQueryLog();
        // return $this->data;
        return view( 'frontend.message.index', $this->data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $message = [
            'product_id'    => $request->product_id,
            'sender_id'     => Auth::user()->id,
            'receiver_id'   => $request->user_id,
            'seen_by_user'  => 0,
            'seen_by_admin' => 0
        ];

        $message = Message::create( $message );

        $message_detail = [
            'quantity'      => $request->quantity,
            'message'       => $request->message,
            'sender_id'     => Auth::user()->id,
            'receiver_id'   => $request->user_id,
            'message_id'    => $message->id,
        ];

        MessageDetail::create( $message_detail );
        
        return response( [ 'status' => 'OK', 'message' => 'Message has been successfully sent.' ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $message                    = Message::find( $id );
        $user_id                    = Auth::user()->id;

        $conversation               = $message::with( 'sender', 'receiver', 'detail.sender.detail', 'detail.receiver.detail' )->where( 'id', $id )->first();
        $this->data['user_id']      = $user_id;
        $this->data['conversation'] = $conversation;
        
        $this->updateSeen( $conversation, $message, $user_id );
        // return $this->data['conversation'];
        return view( 'frontend.message.show', $this->data );
    }

    private function updateSeen( $conversation, $updatableMessage, $user_id )
    {
        $total          = $conversation->detail->count();
        $lastMessage    = $conversation->detail[ ( $total - 1 ) ];
        
        if( $lastMessage->sender->id == $user_id )
        {
            $updatableMessage->seen_by_user = 1;
            $updatableMessage->timestamps    = false;

            $updatableMessage->save();
        }
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
}
