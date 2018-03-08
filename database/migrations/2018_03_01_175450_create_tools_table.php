<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('uploader_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('status');
            $table->bigInteger('views')->nullable(true);
            $table->text('description')->nullable(false);
            $table->text('URL')->nullable(true);
            $table->timestamps();
        });

        Schema::table('tools', function (Blueprint $table) {
            $table->foreign('uploader_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('tool_category');
            $table->foreign('status')->references('status')->on('tool_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
}
