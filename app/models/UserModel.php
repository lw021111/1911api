<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    // 表名
    public $table = 'exam_user';

    // 主键
    public  $primaryKey = 'user_id';


    // 关闭时间补全
    public  $timestamps = false;


}
