<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_images', function (Blueprint $table) {
            $table->string('tool_slug');
            $table->string('image_filename');
            $table->timestamps();

            $table->primary(['tool_slug', 'image_filename']);
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
        Schema::table('tool_images', function (Blueprint $table) {
            Schema::dropIfExists('tool_images');
        });
    }
}
