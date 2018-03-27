<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_specifications', function (Blueprint $table) {
            $table->string('tool_slug');
            $table->string('slug');
            $table->string('name');
            $table->string('value');

            $table->primary(['tool_slug', 'slug']);
            $table->foreign('slug')->references('slug')->on('tool_specification_lookup');
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
        Schema::dropIfExists('tool_specifications');
    }
}
