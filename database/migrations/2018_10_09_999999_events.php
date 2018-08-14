<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Events extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            // $table->integer('events_id')->unsigned();

            $table->string('title');
            $table->longtext('body');
            $table->integer('events_who')->unsigned()->nullable();
            $table->dateTime('whenevent');
            $table->string('where');
            $table->tinyInteger('is_active')->nullable()->default(true);
            $table->tinyInteger('dateapproved')->nullable()->default(false);
            $table->string('category');
            $table->string('created_by');

            // $table->foreign('events_who')->references('id')->on('user_position');
            $table->foreign('events_who')->references('id')->on('Grade');

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
        Schema::dropIfExists('events');
    }
}
