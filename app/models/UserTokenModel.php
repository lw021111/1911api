<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserTokenModel extends Model
{
    // 表名
    public $table = 'exam_user_token';

    // 主键
    public  $primaryKey = 'id';

    // 关闭时间补全
    public $timestamps = false;


}
