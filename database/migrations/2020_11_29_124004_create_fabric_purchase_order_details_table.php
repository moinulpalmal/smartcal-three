<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_purchase_order_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('fabric_product_setup_id')->unsigned();
            $table->integer('input_unit_id')->unsigned();

            $table->string('construction', 150)->nullable();
            $table->string('width', 150)->nullable();
            $table->string('color', 50)->nullable();

            $table->string('order_quantity', 80)->nullable();
            $table->string('unit_price', 80)->nullable();

            $table->string('total_price', 80)->nullable();

            $table->string('status', 4)->default('A');
            $table->string('remarks', 200)->nullable();

            $table->timestamps();

            $table->foreign('purchase_order_master_id')
                ->references('id')
                ->on('purchase_order_masters')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabric_purchase_order_details');
    }
}
