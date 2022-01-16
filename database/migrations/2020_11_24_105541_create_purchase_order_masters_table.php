<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            //$table->string('lpd_po_no', 12)->nullable();
            $table->bigInteger('lpd_po_no')->unsigned()->nullable();
            $table->integer('product_group_id')->unsigned();
            $table->date('lpd_po_date');

            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('buyer_id')->unsigned();
            $table->integer('delivery_location_id')->unsigned();

            $table->text('style')->nullable();
            $table->string('buyer_po_no', 200)->nullable();
            $table->string('consumption_per_dz', 200)->nullable();
            $table->integer('garments_quantity')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();

            $table->date('approval_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('last_revise_date')->nullable();

            $table->boolean('is_revised')->default(0);
            $table->boolean('is_urgent')->default(0);

            $table->bigInteger('inserted_by')->unsigned();
            $table->bigInteger('last_updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('purchase_order_masters');
    }
}
