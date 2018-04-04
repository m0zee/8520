<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$faker = Faker::create();
    	DB::table('categories')->truncate();
    	
    	for ($i=0; $i < 10 ; $i++) {
    	 	$name = $faker->name; 
	        DB::table('categories')->insert([
	            'name' => $name,
	            'slug' => str_slug($name),
	        ]);
    	}
    }
}
