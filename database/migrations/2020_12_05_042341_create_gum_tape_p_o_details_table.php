<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGumTapePODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gum_tape_p_o_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();

            $table->bigInteger('gum_tape_product_setup_id')->unsigned();
            $table->string('size', 100)->nullable();
            $table->integer('input_unit_id')->unsigned();

            $table->string('order_quantity', 150)->nullable();
            $table->string('unit_price', 80)->nullable();
            $table->string('currency', 1);

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
        Schema::dropIfExists('gum_tape_p_o_details');
    }
}
