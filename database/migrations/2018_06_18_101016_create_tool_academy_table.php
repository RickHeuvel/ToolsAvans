<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolAcademyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_academy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('academy_slug');
            $table->string('tool_slug');

            $table->foreign('academy_slug')->references('slug')->on('academy_lookup')->onUpdate('cascade');
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
        Schema::dropIfExists('tool_academy');
    }
}
