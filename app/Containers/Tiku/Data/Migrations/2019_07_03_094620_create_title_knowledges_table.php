<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTitleKnowledgesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('title_knowledges', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('title_id')->comment('试题ID');
            $table->integer('knowledge_id')->comment('知识点ID');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('title_knowledges');
    }
}
