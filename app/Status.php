<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    public function product()
    {
    	return $this->hasOne('App\Product');
    }
    
    public function reviews()
    {
    	return $this->belongsTo( \App\Status::class );
    }
}
