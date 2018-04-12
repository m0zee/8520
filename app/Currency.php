<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function product()
    {
    	return $this->hasOne('App\Product');
    }
}
