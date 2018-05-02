<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [ 'id' ];

    public function product()
    {
    	return $this->belongsTo( 'App\Product' );
    }

    public function sender()
    {
    	return $this->belongsTo( 'App\User' );
    }
}
