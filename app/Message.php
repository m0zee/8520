<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [ 'product_id', 'sender_id', 'receiver_id', 'seen_by_user', 'seen_by_admin' ];

    public function detail()
    {
    	return $this->hasMany( 'App\MessageDetail' );
    }
}
