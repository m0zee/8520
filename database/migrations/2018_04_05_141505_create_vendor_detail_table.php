<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('address');
            $table->string('mobile_number');
            $table->string('phone_number')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('cheque')->nullable();
            $table->integer('card')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('profile_path')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('cover_path')->nullable();
            $table->text('description')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('google_plus')->nullable();
            $table->text('linked_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_details');
    }
}
