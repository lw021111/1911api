<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_user', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_unicode_ci';

            $table->increments('user_id')->comment('用户id,主键');
            $table->string('nick_name',20);
            $table->string('user_name',20);
            $table->char('phone',11);
            $table->string('email',50);
            $table->char('password',32);
            $table->char('rand_code',6);
            $table->char('error_count',6);
            $table->tinyInteger('last_error_time');
            $table->unsignedBigInteger('last_error_ip');
            $table->string('head_img',200);
            $table->integer('age');
            $table->tinyInteger('reg_type');
            $table->tinyInteger('status');
            $table->unsignedInteger('ctime');
            $table->unsignedInteger('utime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_user');
    }
}
