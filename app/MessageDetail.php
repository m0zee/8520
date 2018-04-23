<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
	protected $table 	= 'message_detail';
    protected $fillable	= [ 'quantity', 'message', 'sender_id', 'receiver_id', 'message_id'
	];
}