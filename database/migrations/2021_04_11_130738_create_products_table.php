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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->bigInteger('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('name');

            $table->string('code');
            $table->string('quantity');
            $table->text('details');
            $table->string('color');
            $table->string('size')->nullable();
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('video_link')->nullable();
            $table->integer('main_slider')->nullable();
            $table->integer('mid_slider')->nullable();
            $table->integer('hot_deal')->nullable();
            $table->integer('hot_new')->nullable();
            $table->integer('best_rated')->nullable();
            $table->integer('trend')->nullable();
            $table->integer('buyone_getone')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->boolean('status')->default(0);
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
