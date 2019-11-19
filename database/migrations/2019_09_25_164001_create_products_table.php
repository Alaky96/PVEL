<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("fk_owner");
            $table->string('name');
            $table->string('descr');
            $table->decimal('price');
            $table->boolean('approved');
            $table->boolean('active');
            $table->boolean('out_of_stock');
            $table->decimal('shipping_price');
            $table->integer('fk_categorie')->nullable();
            $table->boolean('featured');
            $table->string("image_path")->nullable();
            $table->integer("fk_category");
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
