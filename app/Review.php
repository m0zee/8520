<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $fillable = [ 'ratings', 'review', 'status_id', 'user_id', 'vendor_code' ];

    // ***************************
    //          RELATIONS
    // ***************************
    public function vendor()
    {
    	return $this->belongsTo( 'App\User', 'vendor_code', 'code' );
    }

    public function user()
    {
    	return $this->belongsTo( 'App\User' );
    }

    public function status()
    {
        return $this->hasOne( 'App\Status', 'id', 'status_id' );
    }
}
