<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->string('slug',200);
            $table->integer('quantity');
            $table->integer('sold');
            $table->float('oldPrice',9,2);
            $table->float('currentPrice',9,2);
            $table->string('image',255);
            $table->integer('react');
            $table->float('promotional',9,2);
            $table->text('description')->nullable();
            $table->unsignedInteger('idCategory');
            $table->unsignedInteger('idProductType');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('idCategory')->references('id')->on('category');
            $table->foreign('idProductType')->references('id')->on('product_type');
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
