<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    // 表名
    public $table = 'shop_goods';

    // 主键
    public  $primaryKey = 'goods_id';

    // 关闭时间补全
    public  $timestamps = false;


}
