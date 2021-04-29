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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

             // $table->bigInteger('order_id')->unsigned();
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();

            // $table->bigInteger('product_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->nullable();

            $table->foreignId('order_id')->constrained();
            $table->foreignId('product_id')->constrained();

            $table->string('product_name')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('qty')->nullable();
            $table->string('singleprice')->nullable();
            $table->string('totalprice')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
