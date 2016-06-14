<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWechatusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wechatusers', function (Blueprint $table) {

            $table->string('openid');
            $table->string('nickname');
            $table->text('headimgurl');
            $table->boolean('sex');
            $table->string('mobile');
            $table->string('name');
            $table->string('department');
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('subscribe_time');
            $table->integer('score')->unsigned();
            $table->integer('second')->unsigned();
            $table->timestamps();
            $table->primary("openid");


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
        Schema::drop('wechatusers');
    }
}
