<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolTeacherReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_teacher_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tool_slug');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->integer('rating');
            $table->text('preview')->nullable();
            $table->text('description')->nullable();
            $table->boolean('recommended')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('tool_teacher_reviews');
    }
}
