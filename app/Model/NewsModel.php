<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    //
    public $table = 'news_news';
    public $primaryKey = 'news_id';
    public $timestamps = false;
    public function getCate(){
        return $this->hasOne("App\Model\Cate","cate_id","cate_id");
    }
}
