<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryLocationDetailIdToPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->bigInteger('delivery_location_detail_id')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->dropColumn(['delivery_location_detail_id']);
        });
    }
}
