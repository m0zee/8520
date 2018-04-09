<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id', 'status', 'email_token', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ***************************
    //          RELATIONS
    // ***************************

    public function detail()
    {
        return $this->hasOne( \App\VendorDetail::class );
    }

    public function reviews()
    {
        return $this->hasMany( \App\Review::class );
    }


    public function user_type()
    {
        return $this->belongsTo( 'App\UserType' );
    }
}
