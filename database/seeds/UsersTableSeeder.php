<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	DB::table('users')->truncate();
    	
    	for( $i = 1; $i < 11 ; $i++ )
        {
            DB::table( 'users' )->insert([
                'name'          => $faker->name,
                'email'         => $faker->email,
	            'user_type_id'  => $faker->randomElement( [ 1, 2 ] ),
                'status'        => 1,
                'code'          => $this->get_code( $i ),
	            'password'      => bcrypt( '123123' ),
	        ]);
    	}

        DB::table('users')->insert([
            'name'          => 'Admin',
            'email'         => 'admin@pakmaterial.com',
            'user_type_id'  => 3,
            'status'        => 1,
            'code'          => $this->get_code( '11' ),
            'password'      => bcrypt( '123123' ),
        ]);

        DB::table('users')->insert([
            'name' => 'Vendor',
            'email' => 'vendor@pakmaterial.com',
            'user_type_id' => '2',
            'status' => '1',
            'code' => $this->get_code('12'),
            'password' => bcrypt('123123'),
        ]);
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
