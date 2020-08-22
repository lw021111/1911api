<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     //主键
        protected $table="news_user";
           protected $primaryKey="user_id";
           public $timestamps=false;
}
