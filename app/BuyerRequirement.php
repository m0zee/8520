<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerRequirement extends Model
{
    protected $guarded = [
        'id'
    ];


    public function user()
    {
        return $this->belongsTo( 'App\User' );
    }


    public function status()
    {
    	return $this->belongsTo( 'App\Status' );
    }

    public function unit()
    {
    	return $this->belongsTo( 'App\Unit' );
    }

    public function category()
    {
        return $this->belongsTo( 'App\Category' );
    }

    public function sub_category()
    {
        return $this->belongsTo( 'App\SubCategory' );
    }

    public function city()
    {
        return $this->hasOne( 'App\City', 'id' );
    }
}
