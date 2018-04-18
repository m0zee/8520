<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];


    public function sub_category()
    {
    	return $this->hasMany('App\SubCategory');
    }


    public function product()
    {
    	return $this->hasMany('App\Product');
    }


    public function buyer_requirement()
    {
        return $this->hasMany('App\BuyerRequirement');
    }
}
