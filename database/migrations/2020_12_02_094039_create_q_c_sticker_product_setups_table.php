<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQCStickerProductSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_c_sticker_product_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 240);
            $table->bigInteger('inserted_by')->unsigned();
            $table->bigInteger('last_updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('q_c_sticker_product_setups');
    }
}
