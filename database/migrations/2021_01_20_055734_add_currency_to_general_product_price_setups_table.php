<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToGeneralProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_product_price_setups', function (Blueprint $table) {
            $table->string('currency', 1)->default('৳');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_product_price_setups', function (Blueprint $table) {
            $table->dropColumn(['currency']);
        });
    }
}
