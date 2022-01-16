<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoColorToFabricPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabric_purchase_order_details', function (Blueprint $table) {
            $table->dropColumn(['color']);
            $table->dropColumn(['construction']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fabric_purchase_order_details', function (Blueprint $table) {
            $table->string('color', 50)->nullable();
            $table->string('construction', 150)->nullable();
        });
    }
}
