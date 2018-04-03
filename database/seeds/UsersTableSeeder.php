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
    	
    	for ($i=0; $i < 10 ; $i++) { 
	        DB::table('users')->insert([
	            'name' => $faker->name,
                'email' => $faker->email,
	            'user_type_id' => $faker->randomElement([1, 2]),
                'status' => '1',
	            'password' => bcrypt('secret'),
	        ]);
    	}

        DB::table('users')->insert([
            'name' => 'Abdul Moiz',
            'email' => 'moiz.hanif786@gmail.com',
            'user_type_id' => '3',
            'status' => '1',
            'password' => bcrypt('321321'),
        ]);
    }
}
