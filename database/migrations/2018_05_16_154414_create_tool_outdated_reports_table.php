<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolOutdatedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_outdated_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tool_slug');
            $table->integer('user_id')->unsigned();
            $table->string('feedback', 1000);
            $table->timestamps();

            $table->foreign('tool_slug')->references('slug')->on('tools')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_outdated_reports');
    }
}
