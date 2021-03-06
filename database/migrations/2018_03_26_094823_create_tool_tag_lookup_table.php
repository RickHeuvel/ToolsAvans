<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolTagLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_tag_lookup', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('name');
            $table->string('category_slug')->nullable();
            $table->boolean('pinned');

            $table->foreign('category_slug')->references('slug')->on('tag_category')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_tag_lookup');
    }
}
