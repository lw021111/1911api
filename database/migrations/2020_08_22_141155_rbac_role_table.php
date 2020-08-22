<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbacRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_role', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_general_ci';

            $table->increments('role_id')->comment('id,主键');
            $table->string('role_name',20);
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
        Schema::dropIfExists('rbac_role');
    }
}
