<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbacAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_admin', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_general_ci';

            $table->increments('admin_id')->comment('id,主键');
            $table->string('admin_name',20);
            $table->string('admin_email',50);
            $table->char('admin_phone',11);
            $table->string('admin_pwd',32);
            $table->string('salt',6);
            $table->tinyInteger('status')->comment('1、待审核 2、锁定。3、正常');
            $table->unsignedInteger('ctime');
            $table->unsignedInteger('utime');
            $table->tinyInteger('admin_type')->comment('1、超级管理员 2、普通管理员\n区别：\n超级管理员不受后台RBAC权限控制\n');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_admin');
    }
}
