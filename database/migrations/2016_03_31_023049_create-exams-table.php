<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->integer('number_s_s')->unsigned();
            $table->integer('number_s_m')->unsigned();
            $table->integer('number_u')->unsigned();
            $table->integer('number_q_s')->unsigned();
            $table->integer('number_q_m')->unsigned();
            $table->dateTime('start');
            $table->dateTime('end');
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
        //
        Schema::drop('exams');
    }
}
