<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [
        'id'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function sub_category()
    {
    	return $this->belongsTo('App\SubCategory');
    }


    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }


    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }

    public function status()
    {
    	return $this->belongsTo('App\Status');
    }

    
}
