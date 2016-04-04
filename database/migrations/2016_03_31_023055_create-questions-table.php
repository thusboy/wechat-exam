<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('questions', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('eid')->unsigned();
            $table->string('title');
            $table->integer('score')->unsigned();
            $table->boolean('choice');
            $table->timestamps();

            $table->foreign('eid')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');
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
        Schema::drop('questions');
    }
}
