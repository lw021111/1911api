<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    // 表名
    public $table = 'shop_category1';

    // 主键
    public  $primaryKey = 'cate_id';

    // 关闭时间补全
    public  $timestamps = false;


}
