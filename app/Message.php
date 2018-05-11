<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $guarded = [ 'id' ];

    // ===============
    //    RELATIONS
    // ===============
    public function product()
    {
        return $this->belongsTo( 'App\Product' );
    }

    public function requirement()
    {
        return $this->belongsTo( 'App\BuyerRequirement' );
    }

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
    // ===============
    //    METHODS
    // ===============
    public static function getMessages( $user_id )
    {
        $sql = "
            SELECT * FROM
            (
                SELECT
                    `m`.`id`, `m`.`product_id`, `m`.`sender_id`, `m`.`receiver_id`, `m`.`requirement_id`, `m`.`seen_by_user`, `m`.`seen_by_admin`, `m`.`updated_at`,
                    `md`.`message`, `md`.`created_at` AS `md_created_at`, `md`.`sender_id` AS `last_sender_id`,
                    `sender`.`name` AS `sender_name`, `sender`.`email` AS `sender_email`, `sender`.`code` AS `sender_code`,
                    `receiver`.`name` AS `receiver_name`, `receiver`.`email` AS `receiver_email`, `receiver`.`code` AS `receiver_code`,
                    `p`.`name` AS `product_name`, `p`.`code` AS `product_code`
                FROM `messages` AS `m` INNER JOIN( SELECT * FROM `message_detail` AS md WHERE id IN( SELECT MAX(id) FROM `message_detail` GROUP BY message_id ) ORDER BY `md`.`id` DESC ) AS md ON `m`.`id` = `md`.`message_id`
                INNER JOIN `products` AS `p` ON `m`.`product_id` = `p`.`id`
                INNER JOIN `users` AS `sender` ON `m`.`sender_id` = `sender`.`id` 
                INNER JOIN `users` AS `receiver` ON `m`.`receiver_id` = `receiver`.`id`
                WHERE `m`.`sender_id` = {$user_id} OR `m`.`receiver_id` = {$user_id}
                GROUP BY `m`.`product_id`, `m`.`sender_id`
                
                UNION ALL
                
                SELECT
                    `m`.`id`, `m`.`product_id`, `m`.`sender_id`, `m`.`receiver_id`, `m`.`requirement_id`, `m`.`seen_by_user`, `m`.`seen_by_admin`, `m`.`updated_at`,
                    `md`.`message`, `md`.`created_at` AS `md_created_at`, `md`.`sender_id` AS `last_sender_id`,
                    `sender`.`name` AS `sender_name`, `sender`.`email` AS `sender_email`, `sender`.`code` AS `sender_code`,
                    `receiver`.`name` AS `receiver_name`, `receiver`.`email` AS `receiver_email`, `receiver`.`code` AS `receiver_code`,
                    `br`.`name` AS `product_name`, `br`.`code` AS `product_code`
                FROM `messages` AS `m` INNER JOIN( SELECT * FROM `message_detail` AS md WHERE id IN( SELECT MAX(id) FROM `message_detail` GROUP BY message_id ) ORDER BY `md`.`id` DESC ) AS md ON `m`.`id` = `md`.`message_id`
                INNER JOIN `buyer_requirements` AS `br` ON `m`.`requirement_id` = `br`.`id`
                INNER JOIN `users` AS `sender` ON `m`.`sender_id` = `sender`.`id` 
                INNER JOIN `users` AS `receiver` ON `m`.`receiver_id` = `receiver`.`id`
                WHERE `m`.`sender_id` = {$user_id} OR `m`.`receiver_id` = {$user_id}
                GROUP BY `m`.`requirement_id`, `m`.`sender_id`
            ) AS `derived_table` ORDER BY `seen_by_user`, `updated_at` DESC
        ";
        $conversations = DB::select( $sql );
        // $conversations = DB::table( 'messages AS m' )->select(
        //     'm.id', 'm.product_id', 'm.sender_id',  'm.receiver_id', 'm.seen_by_user', 'm.seen_by_admin', 'm.updated_at',
        //     'md.message', 'md.created_at AS md_created_at', 'md.sender_id AS last_sender_id', 
        //     'sender.name AS sender_name', 'sender.email AS sender_email', 'sender.code AS sender_code',
        //     'receiver.name AS receiver_name', 'receiver.email AS receiver_email', 'receiver.code AS sender_code',
        //     'p.name AS product_name', 'p.code AS product_code'
        // )
        // ->where( 'm.sender_id', $user_id )->orWhere( 'm.receiver_id', $user_id )
        // ->join( DB::raw( '( SELECT * FROM `message_detail` as md WHERE id IN (SELECT MAX(id) FROM `message_detail` GROUP BY message_id ) ORDER BY md.id DESC ) AS md' ), 'm.id', '=', 'md.message_id' )
        // ->join( 'products AS p',    'm.product_id', '=', 'p.id' )
        // ->join( 'users AS sender',   'm.sender_id', '=', 'sender.id' )
        // ->join( 'users AS receiver', 'm.receiver_id', '=', 'receiver.id' )
        // ->groupBy( ['m.product_id', 'm.sender_id' ] )
        // ->get();

        return $conversations;
    }
}
