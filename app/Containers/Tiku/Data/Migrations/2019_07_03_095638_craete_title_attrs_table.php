<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CraeteTitleAttrsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('title_attrs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('title_id')->comment('试题ID');
            $table->integer('subject_id')->comment('科目ID');
            $table->integer('grade_id')->comment('年级ID');
            $table->integer('type_id')->comment('题型ID');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('title_attrs');
    }
}
