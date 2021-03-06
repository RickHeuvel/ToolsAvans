<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewNegativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_negatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('teacher_review_id')->unsigned();

            $table->foreign('teacher_review_id')->references('id')->on('tool_teacher_reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_negatives');
    }
}
