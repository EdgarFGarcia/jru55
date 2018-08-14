<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('idNumber')->unique();

            // $table->integer('events_id')->unsigned();
            // $table->integer('candidates_id')->unsigned();
            // $table->integer('surveys_id')->unsigned();
            // $table->integer('user_positions_id')->unsigned();

            $table->integer('grade')->unsigned()->nullable()->default('1');
            $table->integer('section')->unsigned()->nullable()->default('1');
            $table->integer('clubs')->unsigned()->nullable()->default('1');
            $table->integer('position')->unsigned()->nullable()->default('3');
            $table->integer('survey')->unsigned()->nullable()->default('1');
            $table->integer('running')->unsigned()->nullable()->default('1');

            $table->string('password');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('gender');
            $table->date('birthdate')->nullable();

            $table->foreign('grade')->references('id')->on('grade');
            $table->foreign('section')->references('id')->on('section');
            $table->foreign('clubs')->references('id')->on('clubs');
            $table->foreign('position')->references('id')->on('user_position');
            $table->foreign('survey')->references('id')->on('survey');
            $table->foreign('running')->references('id')->on('cand_position');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
