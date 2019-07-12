<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
