<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    //
    public $table = 'news_news';
    public $primaryKey = 'news_id';
    public $timestamps = false;
}
