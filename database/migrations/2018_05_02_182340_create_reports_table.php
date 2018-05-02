<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'reports', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'product_id' );
            $table->text( 'message' );
            $table->integer( 'sender_id' );
            $table->tinyInteger( 'notified' )->default( 0 );
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
        Schema::dropIfExists( 'reports' );
    }
}
