<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_p_o_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('general_product_setup_id')->unsigned();
            $table->integer('input_unit_id')->unsigned();


            $table->string('order_quantity', 150)->nullable();
            $table->string('unit_price', 80)->nullable();


            $table->string('total_price', 80)->nullable();

            $table->string('status', 4)->default('A');
            $table->string('remarks', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_p_o_details');
    }
}
