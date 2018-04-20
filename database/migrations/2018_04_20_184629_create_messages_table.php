<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'messages', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'product_id' );
            // $table->integer( 'quantity' );
            // $table->text( 'message' );
            $table->integer( 'sender_id' );
            $table->integer( 'receiver_id' );
            $table->tinyInteger( 'seen_by_user' );
            $table->tinyInteger( 'seen_by_admin' );
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
        Schema::dropIfExists( 'messages' );
    }
}
