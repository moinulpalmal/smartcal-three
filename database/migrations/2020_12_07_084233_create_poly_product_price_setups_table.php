<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolyProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poly_product_price_setups', function (Blueprint $table) {
            $table->bigInteger('poly_product_setup_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();

            $table->string('currency', 1)->default('$');
            $table->string('price_unit', 10)->default('0');

            $table->string('unit_price', 50)->default('0');
            $table->string('first_usd_conversion_value', 50)->default('1')->nullable();
            $table->string('second_usd_conversion_value', 50)->default('1')->nullable();

            $table->string('adhesive_price', 50)->default('0')->nullable();
            $table->string('printing_price', 50)->default('0')->nullable();

            $table->string('status', 4)->default('A');
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
        Schema::dropIfExists('poly_product_price_setups');
    }
}
