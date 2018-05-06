<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_slug');
            $table->string('tool_slug');

            $table->foreign('tag_slug')->references('slug')->on('tool_tag_lookup')->onUpdate('cascade');
            $table->foreign('tool_slug')->references('slug')->on('tools')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_tags');
    }
}
