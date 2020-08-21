<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    // 表名
    public $table = 'exam_message';

    // 主键
    public  $primaryKey = 'id';

    // 关闭时间补全
    public  $timestamps = false;


}
