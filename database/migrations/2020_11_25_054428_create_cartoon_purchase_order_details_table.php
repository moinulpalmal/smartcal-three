<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartoonPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartoon_purchase_order_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('cartoon_product_setup_id')->unsigned();
            $table->boolean('is_board')->default(0);

            $table->integer('input_unit_id')->unsigned();
            $table->integer('converted_unit_id')->unsigned();
            $table->float('unit_conversion_rate', 5, 3)->nullable();

            $table->string('length', 200)->nullable();
            $table->string('width', 200)->nullable();
            $table->string('height', 200)->nullable();
            $table->string('extra', 200)->nullable();
            $table->string('length_width', 200)->nullable();
            $table->string('width_height', 200)->nullable();
            $table->string('width_height_round', 200)->nullable();
            $table->string('square_meter', 200)->nullable();
            $table->string('unit_per_square_meter_price', 200)->nullable();
            $table->string('per_square_meter_price', 200)->nullable();
            $table->bigInteger('order_quantity')->nullable();
            $table->string('total_price', 200)->nullable();

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
        Schema::dropIfExists('cartoon_purchase_order_details');
    }
}
