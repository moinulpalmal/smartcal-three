<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFixedPriceToCartoonProductSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cartoon_product_setups', function (Blueprint $table) {
            $table->boolean('has_sub_measurement')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartoon_product_setups', function (Blueprint $table) {
            $table->dropColumn(['has_sub_measurement']);
        });
    }
}
