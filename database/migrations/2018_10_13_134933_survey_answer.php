<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SurveyAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveyAnswer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student');
            $table->text('answer1');
            $table->text('answer2');
            $table->text('answer3');
            // $table->foreign('student')->references('id')->on('users');
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
        Schema::dropIfExists('surveyAnswer');
    }
}
