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
            $table->string('specification')->primary();
            $table->string('category')->nullable();
            $table->boolean('default');

            $table->foreign('category')->references('slug')->on('tool_category');
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
