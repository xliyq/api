<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CraeteKnowledgeTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('knowledge', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('subject_id')->comment('科目id');
            $table->string('name', 50)->comment('名称');
            $table->integer('pid')->default(0)->comment('父id');
            $table->integer('sort')->comment('排序');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('knowledge');
    }
}
