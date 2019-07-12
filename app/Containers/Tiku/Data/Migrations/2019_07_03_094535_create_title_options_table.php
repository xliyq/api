<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTitleOptionsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('title_options', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('title_id')->comment('试题id');
            $table->text('content')->comment('选项内容');
            $table->boolean('is_right')->comment('是否正确');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('title_options');
    }
}
