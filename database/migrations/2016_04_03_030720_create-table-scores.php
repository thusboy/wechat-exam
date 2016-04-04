<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('scores', function (Blueprint $table) {

            $table->string('openid');
            $table->integer('eid')->unsigned();
            $table->integer('score')->unsigned();
            $table->integer('score_r')->unsigned();
            $table->integer('second')->unsigned();
            $table->timestamps();

            $table->foreign('eid')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');

            $table->foreign('openid')
                ->references('openid')
                ->on('wechatusers')
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
        Schema::drop('scores');
    }
}
