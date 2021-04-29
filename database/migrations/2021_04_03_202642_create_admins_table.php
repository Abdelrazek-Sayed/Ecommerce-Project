<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();


            $table->boolean('data')->nullable();
            $table->boolean('copoun')->nullable();
            $table->boolean('newsletters')->nullable();
            $table->boolean('product')->nullable();
            $table->boolean('blog')->nullable();
            $table->boolean('orders')->nullable();
            $table->boolean('others')->nullable();

            $table->boolean('return')->nullable();
            $table->boolean('contact')->nullable();
            $table->boolean('setting')->nullable();
            $table->boolean('comment')->nullable();


            $table->bigInteger('role')->unsigned();
            $table->foreign('role')->references('id')->on('roles')->onDelete('cascade')->nullable();

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
        Schema::dropIfExists('admins');
    }
}
