<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbacPowerNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_power_node', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_general_ci';

            $table->increments('power_node_id')->comment('权限节点id,主键');

            $table->string('power_node_name',20)->comment('权限节点名称');
            $table->tinyInteger('power_node_level')->comment('权限的层级');
            $table->string('power_node_url')->comment('权限对应的访问路径');
            $table->tinyInteger('status');
            $table->unsignedInteger('ctime');
            $table->unsignedInteger('utime');
            $table->integer('power_node_pid')->comment('父级id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_power_node');
    }
}
