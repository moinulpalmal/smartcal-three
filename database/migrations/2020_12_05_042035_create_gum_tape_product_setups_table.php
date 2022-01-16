<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGumTapeProductSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gum_tape_product_setups', function (Blueprint $table) {
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
        Schema::dropIfExists('gum_tape_product_setups');
    }
}
