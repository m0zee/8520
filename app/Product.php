<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $guarded = [
        'id'
    ];


    public function user()
    {
    	return $this->belongsTo( 'App\User' );
    }

    public function sub_category()
    {
    	return $this->belongsTo( 'App\SubCategory' );
    }


    public function category()
    {
        return $this->belongsTo( 'App\Category' );
    }


    public function currency()
    {
    	return $this->belongsTo( 'App\Currency' );
    }


    public function unit()
    {
    	return $this->belongsTo( 'App\Unit' );
    }

    public function status()
    {
    	return $this->belongsTo( 'App\Status' );
    }

    public function users()
    {
        return $this->belongsToMany( 'App\User' );
    }


    public function country()
    {
        return $this->belongsTo( 'App\Country' );
    }


    public function gallery()
    {
        return $this->hasMany('App\ProductGallery');
    }


    public static function search( $query, $category_id )
    {
        $sql = "
            SELECT 
                p.*, u.name as user_name, u.code as user_code, vd.profile_img as user_profile_img, vd.profile_path as user_profile_path, vd.company_name, c.slug as category_slug, c.name as category_name, sc.slug as sub_category_slug, sc.name as sub_category_name, cur.name as currency_name, un.name as unit_name 
            FROM `products` as `p`
            JOIN `users` as `u` ON `u`.`id` = `p`.`user_id` 
            JOIN `vendor_details` as `vd` ON `vd`.`user_id` = `u`.`id`
            JOIN `sub_categories` as `sc` ON `p`.`sub_category_id` = `sc`.`id`
            JOIN `categories` as `c` ON `p`.`category_id` = `c`.`id`
            JOIN `currencies` as `cur` ON `p`.`currency_id` = `cur`.`id`
            JOIN `units` as `un` ON `p`.`unit_id` = `un`.`id`

            Where `p`.`status_id` = 2
            and `u`.`approved_by` != ''
        ";
        if( $query != NULL ) 
        {
            $sql .= " and (
                    `p`.`name`          like  '%{$query}%' 
                or  `p`.`description`   like  '%{$query}%' 
                or  `p`.`brand_name`    like  '%{$query}%' 
                or  `u`.`name`          like  '%{$query}%'
                or  `vd`.`company_name` like  '%{$query}%'
            )";
        }
        if( $category_id > 0 ) 
        {
            $sql .= ' and `p`.`category_id` = '.$category_id;
        }

        $records = DB::select( $sql );

        return $records;
    }
}
