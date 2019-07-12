<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('subjects', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 50);

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('subjects');
    }
}
