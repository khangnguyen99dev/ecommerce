<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->unsignedInteger('idOrder');
            $table->unsignedInteger('idProduct');
            $table->integer('quantity');
            $table->float('price',9,2);
            $table->timestamps();

            $table->foreign('idOrder')->references('id')->on('order');
            $table->foreign('idProduct')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
