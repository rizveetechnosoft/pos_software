<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_imeis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('variation_location_detail_id');
            $table->string('imei_1')->unique()->nullable();
            $table->string('imei_2')->unique()->nullable();
            $table->boolean('is_sold')->default(false);
            $table->unsignedBigInteger('transaction_id')->nullable(); // sell_transaction_id
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
        Schema::dropIfExists('product_imeis');
    }
};
