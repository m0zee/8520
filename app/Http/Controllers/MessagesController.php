<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\MessageReplyRequest;

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
        $this->data['user_type_id']     = Auth::user()->user_type_id;
        $this->data['conversations']    = Message::getMessages( $this->data['user_id'] ); 
        
        return view( 'frontend.message.index', $this->data );
    }

    public function getNewMessageCount()
    {
        switch( Auth::user()->user_type_id )
        {
            case 3:
                $messageCount   = Message::where( 'seen_by_admin', 0 )->count();
            break;
            
            default:
                $user_id        = Auth::user()->id;
                $messageCount   = Message::getUnreadMessageCount( $user_id );
            break;
        };

        if( request()->ajax() )
        {
            return response( [ 'status'=> 'ok', 'messageCount' => $messageCount ], 200 );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validateRequest( $request );

        $message = [
            'product_id'        => $request->product_id,
            'sender_id'         => Auth::user()->id,
            'receiver_id'       => $request->user_id,
            'requirement_id'    => $request->requirement_id,
            'seen_by_user'      => 0,
            'seen_by_admin'     => 0
        ];
        
        $message = Message::create( $message );
        
        $this->saveMessageDetail( $request, $message->id );
        
        if( $request->ajax() )
        {
            return response( [ 'status' => 'OK', 'message' => 'Message has been successfully sent.' ], 200 );
        }

        return redirect()->route( 'messages.index' )->with( 'success', 'Message has been successfully sent!' );
    }

    private function validateRequest( $request )
    {
        $this->validate( $request,
            [
                'message'   => 'required',
                'quantity'  => 'required'
            ],
            [
                'message.required'    => 'Please enter your message.',
                'quantity.required'    => 'Please enter quantity.' 
            ]
        );
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

        if( $message->product_id != null )
        {
            $conversation = $message::with( 'product.unit', 'sender', 'receiver', 'detail.sender.detail', 'detail.receiver.detail' )->where( 'id', $id )->first();
        }
        else if( $message->requirement_id != null )
        {
            $conversation = $message::with( 'requirement.unit', 'sender', 'receiver', 'detail.sender.detail', 'detail.receiver.detail' )->where( 'id', $id )->first();
        }
        
        $this->data['user_id']      = $user_id;
        $this->data['conversation'] = $conversation;
        
        $this->updateSeen( $conversation, $message, $user_id );
        
        return view( 'frontend.message.show', $this->data );
    }

    private function updateSeen( $conversation, $updatableMessage, $user_id )
    {
        $total          = $conversation->detail->count();
        $lastMessage    = $conversation->detail[ ( $total - 1 ) ];
        
        if( $lastMessage->sender->id != $user_id )
        {
            $updatableMessage->seen_by_user = 1;
            $updatableMessage->timestamps   = false;

            $updatableMessage->save();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply( MessageReplyRequest $request, Message $message )
    {
        $message->seen_by_user  = 0;
        $message->seen_by_admin = 0;
        $message->save();

        $receiver_id = ( $message->receiver_id == Auth::user()->id ) ? $message->sender_id : $message->receiver_id;
        $this->saveMessageDetail( $request, $message->id, $receiver_id );

        return redirect()->back()->with( 'success', 'Message has been successfully sent!' );
    }





    private function saveMessageDetail( $request, $message_id, $receiver_id = null )
    {
        $message_detail = [
            'quantity'      => ( $request->quantity == null ) ? 0 : $request->quantity,
            'message'       => ( $request->reply == null ) ? $request->message : $request->reply,
            'sender_id'     => Auth::user()->id,
            'receiver_id'   => ( $receiver_id == null ) ? $request->user_id : $receiver_id,
            'message_id'    => $message_id,
        ];

        $inserted = MessageDetail::create( $message_detail );

        return $inserted->id;
    }
}
