<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("fk_customer");
            $table->dateTime("purchase_date");
            $table->decimal("subtotal");
            $table->decimal("shipping_cost");
            $table->decimal("taxes_cost")->default(0);
            $table->decimal("total");
            $table->string("status");
            $table->string("adresse_line_1")->nullable();
            $table->string("adresse_line_2")->nullable();
            $table->string("city")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("phone")->nullable();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("prov")->nullable();
            $table->string("country")->nullable();
            $table->string("config_key")->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
