<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolSpecificationLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_specification_lookup', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('name');
            $table->string('category')->nullable();
            $table->boolean('default');

            $table->foreign('category')->references('slug')->on('tool_category')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_specification_lookup');
    }
}
