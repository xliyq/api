<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTitleTypesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('title_types', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('subject_id')->comment('科目ID');
            $table->string('name', 50)->comment('名称');
            $table->boolean('support_online')->comment('是否支持在线');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('title_types');
    }
}
