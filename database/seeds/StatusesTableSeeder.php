<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->truncate();

        $statuses = [
        	['name' => 'Pending'],
        	['name' => 'Approved'],
        	['name' => 'Rejected'],
        	['name' => 'Active'],
        	['name' => 'Inactive'],
        ];

        DB::table('statuses')->insert( $statuses );
    }
}
