<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
     public $table = 'news_user';
        public $primaryKey = 'user_id';
        public $timestamps = false;
}
