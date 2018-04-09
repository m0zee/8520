<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    protected $guarded  = [
       'id', 'created_at', 'updated_at'
    ];



    

    public function user()
    {
    	return $this->belognsTo( \App\User::class );
    }
}
