<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElasticPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elastic_purchase_order_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('elastic_product_setup_id')->unsigned();
            $table->integer('input_unit_id')->unsigned();

            $table->string('size', 80)->nullable();
            $table->string('color', 255)->nullable();

            $table->string('order_quantity', 80)->nullable();
            $table->string('gross_form_factor', 80)->nullable();
            $table->string('gross_order_quantity', 80)->nullable();
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
        Schema::dropIfExists('elastic_purchase_order_details');
    }
}
