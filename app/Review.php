<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    // ***************************
    //          RELATIONS
    // ***************************
    public function vendor()
    {
    	return $this->belongsTo( \App\User::class, 'vendor_code', 'code' );
    }

    public function user()
    {
    	return $this->belongsTo( \App\User::class );
    }

    // ***************************
    //          ACCESSORS
    // ***************************
    // public function getCreatedAtAttribute( $value )
    // {
    // 	# code...
    // }
}
