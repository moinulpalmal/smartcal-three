<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_p_o_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('thread_product_setup_id')->unsigned();
            $table->integer('input_unit_id')->unsigned();

            $table->string('color', 100)->nullable();
            $table->string('shade', 100)->nullable();

            $table->string('garments_order_quantity', 150)->nullable();
            $table->string('consumption', 150)->nullable();
            $table->string('per_con_length', 80)->nullable();


            $table->string('order_quantity', 150)->nullable();
            $table->string('unit_price', 80)->nullable();
            $table->tinyInteger('decimal_count')->default(2);

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
        Schema::dropIfExists('thread_p_o_details');
    }
}
