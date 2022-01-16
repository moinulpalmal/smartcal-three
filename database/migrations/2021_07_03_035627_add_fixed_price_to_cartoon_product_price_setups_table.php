<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFixedPriceToCartoonProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cartoon_product_price_setups', function (Blueprint $table) {
            $table->string('measurement_detail', 150)->nullable()->default('-');
            $table->float('length')->default(0);
            $table->float('width')->default(0);
            $table->float('height')->default(0);
            $table->integer('input_unit_id')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartoon_product_price_setups', function (Blueprint $table) {
            $table->dropColumn(['measurement_detail']);
            $table->dropColumn(['length']);
            $table->dropColumn(['width']);
            $table->dropColumn(['height']);
            $table->dropColumn(['input_unit_id']);
        });
    }
}
