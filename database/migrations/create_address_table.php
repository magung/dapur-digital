<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->bigInteger('customer_id', false, true);
            $table->string('name');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('address');
            $table->string('note');
            $table->string('postal_code');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
