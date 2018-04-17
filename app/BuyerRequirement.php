<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerRequirement extends Model
{
    protected $guarded = [
        'id'
    ];

    public function status()
    {
    	return $this->belongsTo('App\Status');
    }

    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }
}
