<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->truncate();

        DB::table('user_types')->insert([
            'name' => 'Buyer',
            'description' => 'Buyer'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Vendor',
            'description' => 'Vendor'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Admin',
            'description' => 'Admin'
        ]);
    }
}
