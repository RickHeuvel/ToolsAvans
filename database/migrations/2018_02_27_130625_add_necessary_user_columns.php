<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNecessaryUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_category', function (Blueprint $table) {
            $table->string('category',100)->primary();
            $table->timestamps();
        });

        Schema::create('tool_status', function (Blueprint $table) {
            $table->string('status',100)->primary();
            $table->timestamps();
        });

        Schema::table('tools', function (Blueprint $table) {
            $table->integer('uploader_id')->unsigned();
            $table->string('category', 100);
            $table->string('status', 100);

            $table->bigInteger('views')->nullable(true);
            $table->text('description')->nullable(false);
            $table->text('URL')->nullable(true);

            $table->foreign('uploader_id')->references('id')->on('users');
            $table->foreign('category')->references('category')->on('tool_category');
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
        Schema::dropIfExists('tool_category');
        Schema::dropIfExists('tool_status');
    }
}
