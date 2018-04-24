<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $fillable = [ 'product_id', 'sender_id', 'receiver_id', 'seen_by_user', 'seen_by_admin' ];

    public function detail()
    {
    	return $this->hasMany( 'App\MessageDetail' );
    }

    public function sender()
    {
    	return $this->hasOne( 'App\User', 'id', 'sender_id' );
    }

    public function receiver()
    {
    	return $this->hasOne( 'App\User', 'id', 'receiver_id' );
    }

    public static function getMessages( $user_id )
    {
        // SELECT
        // `product_id`, m.sender_id,  m.receiver_id, m.seen_by_user, m.seen_by_admin, md.quantity, md.message 
        // FROM `messages` AS `m`
        // INNER JOIN ( SELECT * FROM `message_detail` as md ORDER BY md.id DESC LIMIT 1 ) AS `md` ON `m`.`id` = `md`.`message_id`
        // WHERE `m`.`sender_id` = 12 OR `m`.`receiver_id` = 12
        $conversations = DB::table( 'messages AS m' )->select(
            'm.id', 'm.product_id', 'm.sender_id',  'm.receiver_id', 'm.seen_by_user', 'm.seen_by_admin', 'm.updated_at',
            'md.message', 'md.created_at AS md_created_at', 'md.sender_id AS last_sender_id', 
            'sender.name AS sender_name', 'sender.email AS sender_email', 'sender.code AS sender_code',
            'receiver.name AS receiver_name', 'receiver.email AS receiver_email', 'receiver.code AS sender_code',
            'p.name AS product_name', 'p.code AS product_code'
        )
        ->where( 'm.sender_id', $user_id )->orWhere( 'm.receiver_id', $user_id )
        ->join( DB::raw( '( SELECT * FROM `message_detail` as md WHERE id IN (SELECT MAX(id) FROM `message_detail` GROUP BY message_id ) ORDER BY md.id DESC ) AS md' ), 'm.id', '=', 'md.message_id' )
        ->join( 'products AS p',    'm.product_id', '=', 'p.id' )
        ->join( 'users AS sender',   'm.sender_id', '=', 'sender.id' )
        ->join( 'users AS receiver', 'm.sender_id', '=', 'receiver.id' )
        ->groupBy( ['m.product_id', 'm.sender_id' ] )
        ->get();

        return $conversations;
    }
}
