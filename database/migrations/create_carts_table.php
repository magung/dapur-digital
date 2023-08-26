<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->bigInteger('product_id');
            $table->bigInteger('qty');
            $table->bigInteger('price');
            $table->bigInteger('panjang');
            $table->bigInteger('lebar');
            $table->bigInteger('total_price');
            $table->bigInteger('user_id');
            $table->string('satuan');
            $table->bigInteger('finishing_id');
            $table->bigInteger('cutting_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('finishing_price');
            $table->bigInteger('cutting_price');
            $table->text('file');
            $table->bigInteger('luas');
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
        Schema::dropIfExists('carts');
    }
}
