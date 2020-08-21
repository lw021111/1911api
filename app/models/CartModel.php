<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    // 表名
    public $table = 'shop_cart';

    // 主键
    public  $primaryKey = 'cart_id';

    // 关闭时间补全
    public  $timestamps = false;


}
