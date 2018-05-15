<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['messages'] = Message::with( 'sender', 'receiver', 'product.sub_category.category', 'requirement' )
        ->orderBy( 'seen_by_admin' )->orderBy( 'updated_at', 'DESC' )->paginate( 15 );
        // return $this->data['messages'][0];//->product->category;
        // categories/{category_slug}/sub-categories/{sub_category_slug}/products/{code}/{slug}
        return view( 'backend.message.index', $this->data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $message                = Message::find( $id );
        
        if( $message !== null )
        {
            $message->seen_by_admin = 1;
            $message->timestamps    = false;

            $message->save();
            
            $this->data['conversation'] = $message::with( 'detail.sender.detail', 'detail.receiver.detail' )->where( 'id', $id )->first();
        }


        // return $this->data['conversation'];
        return view( 'backend.message.show', $this->data );
    }
}
