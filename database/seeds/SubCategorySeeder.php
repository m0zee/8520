<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	DB::table('sub_categories')->truncate();
    	
    	for ($i=0; $i < 100 ; $i++) {
    	 	$name = $faker->name; 
	        DB::table('sub_categories')->insert([
	            'name' => $name,
	            'slug' => str_slug($name),
	            'category_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
	        ]);
    	}
    }
}
