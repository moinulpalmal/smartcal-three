<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToFabricPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabric_purchase_order_details', function (Blueprint $table) {
            $table->string('color', 250)->nullable();
            $table->string('construction', 250)->nullable();
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
            $table->dropColumn(['color']);
            $table->dropColumn(['construction']);
        });
    }
}
