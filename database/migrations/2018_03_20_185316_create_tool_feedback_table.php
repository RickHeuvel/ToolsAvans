<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_feedback', function (Blueprint $table) {
            $table->string('tool_slug')->primary();
            $table->string('feedback', 1000)->nullable();
            $table->boolean('fixed')->default(false);
            $table->timestamps();

            $table->foreign('tool_slug')->references('slug')->on('tools')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
