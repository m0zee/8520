<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'name' );
            $table->string( 'code' );
            $table->text( 'description' );
            $table->integer( 'sub_category_id' );
            $table->string( 'brand_name' );
            $table->string( 'country_id' ); // MADE IN Country 
            $table->integer( 'max_supply' );
            $table->integer( 'unit_id' );
            $table->integer('currency_id');
            $table->integer( 'price' );
            $table->string( 'img_path' );
            $table->string( 'img' );
            $table->integer( 'status_id' );
            $table->integer( 'user_id' );
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
        Schema::dropIfExists('products');
    }
}
