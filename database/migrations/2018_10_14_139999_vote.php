<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->nullable();
            $table->bigInteger('votes');
            $table->date('year_of');
            $table->integer('running_for')->unsigned()->nullable();
            $table->tinyInteger('is_open')->nullable()->default(true);
            $table->tinyInteger('approved')->nullable()->default(false);
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('running_for')->references('id')->on('cand_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote');
    }
}
