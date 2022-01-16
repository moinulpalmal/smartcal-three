<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldLpdPoToPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->bigInteger('old_lpd_po_no')->unsigned()->default(0);
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
            $table->dropColumn(['old_lpd_po_no']);
        });
    }
}
