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
            $table->string('slug')->primary();
            $table->string('name')->unique();
            $table->text('description')->nullable(false);
            $table->text('url')->nullable(true);
            $table->integer('uploader_id')->unsigned();
            $table->string('category_slug');
            $table->string('status');
            $table->string('logo_filename');
            $table->timestamps();

            $table->foreign('uploader_id')->references('id')->on('users')->onUpdate('cascade')->onDelete();
            $table->foreign('category_slug')->references('slug')->on('tool_category')->onUpdate('cascade');
            $table->foreign('status')->references('status')->on('tool_status')->onUpdate('cascade');
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
