<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
     //主键
            protected $table="news_cate";
               protected $primaryKey="cate_id";
               public $timestamps=false;
}
