<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbacAdminRoleRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_admin_role_relation', function (Blueprint $table) {
            //设置表引擎
            $table->engine='InnoDB';
            //字符集
            $table->charset='utf8';
            //校对
            $table->collation='utf8_general_ci';

            $table->increments('id')->comment('id,主键');
            $table->integer('admin_id');
            $table->integer('role_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_admin_role_relation');
    }
}
