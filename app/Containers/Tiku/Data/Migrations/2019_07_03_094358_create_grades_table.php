<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('grades', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('grades');
    }
}
