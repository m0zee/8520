<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'message_detail', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'quantity' );
            $table->text( 'message' );
            $table->integer( 'sender_id' );
            $table->integer( 'receiver_id' );
            $table->integer( 'message_id' );
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
        Schema::dropIfExists( 'message_detail' );
    }
}
