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
        Schema::table('product_imeis', function (Blueprint $table) {
            // Remove existing unique constraints on imei_1 and imei_2
            $table->dropUnique('product_imeis_imei_1_unique'); // Adjust index name if necessary
            $table->dropUnique('product_imeis_imei_2_unique'); // Adjust index name if necessary

            // Add composite unique index for imei_1 and imei_2 with variation_location_detail_id
            $table->unique(['imei_1', 'variation_location_detail_id']);
            $table->unique(['imei_2', 'variation_location_detail_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_imeis', function (Blueprint $table) {
            // Remove the composite unique index with variation_location_detail_id column in case of rollback
            $table->dropUnique(['imei_1', 'variation_location_detail_id']);
            $table->dropUnique(['imei_2', 'variation_location_detail_id']);

            // Re-add the unique constraints on imei_1 and imei_2
            $table->unique('imei_1');
            $table->unique('imei_2');
        });
    }
};
