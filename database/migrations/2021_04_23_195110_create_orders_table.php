<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();

            $table->foreignId('user_id')->constrained();

            $table->string('payment_type')->nullable();

            $table->string('stripe_order_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('paying_amount')->nullable();
            $table->string('balance_transaction')->nullable();

            $table->string('subtotal')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('vat')->nullable();
            $table->string('total')->nullable();

            $table->integer('status')->default(0)->nullable();
            $table->string('status_code')->nullable();

            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
