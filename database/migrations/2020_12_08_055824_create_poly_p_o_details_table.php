<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolyPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poly_p_o_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('item_count')->unsigned();
            $table->string('item_details', 240)->nullable();

            $table->bigInteger('poly_product_setup_id')->unsigned();
            $table->integer('input_unit_id')->unsigned();
            $table->integer('converted_unit_id')->unsigned();

            $table->string('width', 240)->nullable();
            $table->string('length', 240)->nullable();
            $table->integer('width_length_unit_id')->unsigned();
            $table->integer('converted_width_length_unit_id')->unsigned();
            $table->string('conversion_rate', 10)->nullable();

            $table->string('converted_width', 240)->nullable();
            $table->string('converted_length', 240)->nullable();

            $table->string('thickness', 240)->nullable();
            $table->string('flap', 240)->nullable();
            $table->string('flap_type', 5)->nullable();
            $table->string('measurement', 240)->nullable();

            //for non printed poly
            $table->string('qty_per_lbs', 80)->nullable();
            $table->string('total_lbs_qty', 80)->nullable();
            //for non printed poly

            //for common or h&m adhesive
            $table->string('pcs_per_lbs', 80)->nullable();
            $table->string('px_pcs', 80)->nullable();
            //for common or h&m adhesive

            $table->string('first_usd_conversion_value', 50)->default('1')->nullable();
            $table->string('second_usd_conversion_value', 50)->default('1')->nullable();
            $table->string('adhesive_price', 50)->default('0')->nullable();
            $table->string('total_adhesive_price', 50)->default('0')->nullable();
            $table->integer('printing_color_count')->unsigned()->nullable();
            $table->string('printing_price', 50)->default('0')->nullable();
            $table->string('total_printing_price', 50)->default('0')->nullable();



            $table->string('order_quantity', 150)->nullable();

            $table->string('price_unit', 10)->default('0');
            $table->string('currency', 1)->default('$');
            $table->string('unit_price', 80)->nullable();
            $table->string('total_unit_price', 80)->nullable();
            $table->string('converted_unit_price', 80)->nullable();
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
        Schema::dropIfExists('poly_p_o_details');
    }
}
