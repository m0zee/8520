<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function state()
    {
    	return $this->hasMany('App\State');
    }


    public function product()
    {
    	return $this->hasMany('App\Product');
    }
}
