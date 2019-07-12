<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTitlesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('titles', function (Blueprint $table) {

            $table->increments('id');
            $table->text('content')->comment('试题内容');
            $table->text('analysis')->comment('解析');
            $table->json('answers')->comment('答案');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('titles');
    }
}
