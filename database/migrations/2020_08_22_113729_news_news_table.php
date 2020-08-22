<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_news', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_general_ci';

            $table->increments('news_id')->comment('新闻id,主键');
            $table->string('news_title',100);
            $table->string('news_content',255)->comment('新闻内容');
            $table->string('news_img',200);
            $table->string('news_access',200)->comment('访问人数');
            $table->string('news_give',100)->comment('点赞人数');
            $table->string('news_shield',100)->comment('炸,屏蔽');
            $table->integer('cate_id');
            $table->integer('com_id');
            $table->tinyInteger('is_reco');
            $table->tinyInteger('is_colle');
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
        Schema::dropIfExists('news_news');
    }
}
