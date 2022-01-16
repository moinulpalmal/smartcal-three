<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderUnitToPolyPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poly_p_o_details', function (Blueprint $table) {
            $table->integer('order_unit_id')->unsigned();
            $table->string('total_unit_price_unit',10)->nullable();

            $table->dropColumn(['input_unit_id']);
            $table->dropColumn(['converted_unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poly_p_o_details', function (Blueprint $table) {
            $table->dropColumn(['order_unit_id']);
            $table->dropColumn(['total_unit_price_unit']);

            $table->integer('input_unit_id')->unsigned();
            $table->integer('converted_unit_id')->unsigned();
        });
    }
}
