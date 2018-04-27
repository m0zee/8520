<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBuyerRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_requirements', function (Blueprint $table) {
            $table->string('img')->after('sub_category_id');
            $table->string('path')->after('sub_category_id');
            $table->integer('city_id')->after('sub_category_id');
            $table->integer('state_id')->after('sub_category_id');
            $table->integer('country_id')->after('sub_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_requirements', function (Blueprint $table) {
            $table->dropColumn(['img', 'path', 'country_id', 'state_id', 'city_id']);
        });
    }
}
