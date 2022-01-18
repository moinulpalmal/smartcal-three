<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryStatusTPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->date('tna_start_date')->nullable();
            $table->date('tna_end_date')->nullable();
            $table->date('delivery_complete_date')->nullable();
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
            $table->dropColumn(['tna_start_date']);
            $table->dropColumn(['tna_end_date']);
            $table->dropColumn(['delivery_complete_date']);
        });
    }
}
