<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_product_price_setups', function (Blueprint $table) {
            $table->bigInteger('general_product_setup_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();
            $table->string('unit_price', 100)->default('0');
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
        Schema::dropIfExists('general_product_price_setups');
    }
}
