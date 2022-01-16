<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQCStickerProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_c_sticker_product_price_setups', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('q_c_sticker_product_setup_id')->unsigned();

            //$table->string('article_no', 100)->nullable();

            $table->bigInteger('supplier_id')->unsigned();
            $table->float('unit_price', 12, 10)->default(0);
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
        Schema::dropIfExists('q_c_sticker_product_price_setups');
    }
}
