<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_lists', function (Blueprint $table) {
            $table->id('transaction_list_id');
            $table->bigInteger('store_id', false, true);
            $table->bigInteger('transaction_type_id', false, true);
            $table->bigInteger('transaction_status_id', false, true);
            $table->bigInteger('payment_method_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->bigInteger('final_price');
            $table->bigInteger('created_by', false, true);
            $table->bigInteger('updated_by', false, true);
            $table->bigInteger('payment_status_id', false, true);
            $table->text('bukti_pembayaran');
            $table->bigInteger('courier_id', false, true);
            $table->bigInteger('courier_price', false, true);
            $table->bigInteger('customer_id', false, true);
            $table->bigInteger('address_id', false, true);
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
        Schema::dropIfExists('transaction_lists');
    }
}
