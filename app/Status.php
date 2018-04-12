<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // ***************************
    //          RELATIONS
    // ***************************
    public function reviews()
    {
    	return $this->belongsTo( \App\Status::class );
    }
}
