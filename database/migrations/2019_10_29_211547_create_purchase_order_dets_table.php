<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_dets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_po');
            $table->integer('fk_product');
            $table->integer('fk_vendor');
            $table->integer('qty');
            $table->decimal('unit_price');
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
        Schema::dropIfExists('purchase_order_dets');
    }
}
