<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoCalToThreadPODetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thread_p_o_details', function (Blueprint $table) {
            $table->boolean('no_cal')->default(0)->nullable();
            $table->dropColumn(['color']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thread_p_o_details', function (Blueprint $table) {
            $table->dropColumn(['no_cal']);
            $table->string('color', 100)->nullable();
        });
    }
}
