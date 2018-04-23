<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	
    	DB::table('reviews')->truncate();
    	
    	for( $i = 0; $i < 10 ; $i++ )
        {
        	$user_id = $faker->numberBetween($min = 1, $max = 12);
            DB::table( 'reviews' )->insert([
	           'ratings' 		=> $faker->numberBetween($min = 1, $max = 5),
	           'review' 		=> $faker->text,
	           'status_id'		=> $faker->numberBetween($min = 1, $max = 3),
	           'user_id' 		=> $user_id,
	           'vendor_code'	=> $this->get_code($user_id),
               'created_at'    => date( 'Y-m-d H:i:s' ),
               'updated_at'    => date( 'Y-m-d H:i:s' ),
	        ]);
    	}
    }



    public function get_code($index)
    {
        $length = strlen( $index );

        switch( $length )
        {
            case 1:
                $index = '000' . $index;
            break;

            case 2:
                $index = '00' . $index;
            break;
            
            case 3:
                $index = '0' . $index;
            break;
        }
        $code = 'u-' . $index;
        return $code;
    }
}
