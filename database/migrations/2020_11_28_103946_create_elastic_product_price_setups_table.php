<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElasticProductPriceSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elastic_product_price_setups', function (Blueprint $table) {
            $table->bigInteger('elastic_product_setup_id')->unsigned();

            $table->bigInteger('supplier_id')->unsigned();
            //$table->float('per_sqm_price', 12, 10)->default(0);
            $table->string('status', 4)->default('A');

            $table->foreign('elastic_product_setup_id')
                ->references('id')
                ->on('elastic_product_setups')
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
        Schema::dropIfExists('elastic_product_price_setups');
    }
}
