<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoCalToCartoonPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cartoon_purchase_order_details', function (Blueprint $table) {
            $table->boolean('no_cal')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartoon_purchase_order_details', function (Blueprint $table) {
            $table->dropColumn(['no_cal']);
        });
    }
}
