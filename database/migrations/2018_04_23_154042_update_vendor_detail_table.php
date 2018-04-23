<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVendorDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_details', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'twitter', 'google_plus', 'linked_in']);
            $table->integer('cod')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_details', function (Blueprint $table) {
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('google_plus')->nullable();
            $table->text('linked_in')->nullable();
            $table->dropColumn(['cod']);

        });
    }
}
