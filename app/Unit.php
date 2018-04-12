<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function product()
    {
    	return $this->hasOne('App\Product');
    }
}
