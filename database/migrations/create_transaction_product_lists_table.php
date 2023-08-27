<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionProductListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_product_lists', function (Blueprint $table) {
            $table->id('transaction_product_list_id');
            $table->bigInteger('transaction_list_id', false, true);
            $table->bigInteger('product_id', false, true);
            $table->bigInteger('qty');
            $table->bigInteger('panjang');
            $table->bigInteger('lebar');
            $table->enum('satuan', ['M', 'PCS']);
            $table->bigInteger('price');
            $table->bigInteger('total_price');
            $table->bigInteger('finishing_id', false, true);
            $table->bigInteger('cutting_id', false, true);
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
        Schema::dropIfExists('transaction_product_lists');
    }
}
