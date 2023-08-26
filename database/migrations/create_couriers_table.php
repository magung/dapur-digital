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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id('courier_id');
            $table->string('courier_name', 100);
            $table->string('courier_code', 100);
            $table->string('courier_service_name', 100);
            $table->string('courier_service_code', 100);
            $table->string('description', 100);
            $table->string('service_type', 100);
            $table->string('shipping_type', 100);
            $table->string('shipment_duration_range', 100);
            $table->string('shipment_duration_unit', 100);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
