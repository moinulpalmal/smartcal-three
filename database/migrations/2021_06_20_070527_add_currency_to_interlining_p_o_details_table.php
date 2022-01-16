<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToInterliningPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interlining_p_o_details', function (Blueprint $table) {
            $table->string('currency', 1)->default('$');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interlining_p_o_details', function (Blueprint $table) {
            $table->dropColumn(['currency']);
        });
    }
}
