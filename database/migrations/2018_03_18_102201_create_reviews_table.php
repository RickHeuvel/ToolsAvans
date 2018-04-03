<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->string('tool_slug');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->integer('rating');
            $table->text('description');
            $table->timestamps();

            $table->primary(['tool_slug', 'user_id']);
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
        Schema::dropIfExists('reviews');
    }
}
