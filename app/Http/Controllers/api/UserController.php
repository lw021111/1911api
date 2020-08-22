<?php

namespace App\Http\Controllers\api;

use App\Exceptions\ApiExceptionss;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\model\MsgModel;
use Illuminate\Http\Request;
/*
 * 用户相关接口
 * */
class UserController extends CommonController
{
    //注册接口
    public function reg (Request $request){
        $tt = $this -> checkApiParam('tt');
        $phone = $this ->checkApiParam('phone');
        $msg_code = $this->checkApiParam('msg_code');
        $password = $this->checkApiParam('password');

        $preg = '/^1{1}\d{10}$/';

        #验证手机号格式
        if( !preg_match_all($preg,$phone)){
            throw new ApiExceptions('手机号格式错误');
        }
        #验证手机号是不是存在
        if($this ->checkUserExists( $phone )>0){
            throw new ApiExceptions('手机号已经存在');
        }
        #验证短信验证码  验证短信验证码是否过期  验证是否正确
        $msg_model = new MsgModel();
        $where = [
            ['phone' , '=' ,$phone],
            ['type' , '=', 1]
        ];
        $msg_model ->where($where) ->orderBy('msg_id','desc')->first();
        if(empty($msg_obj)){
            throw new ApiExceptions('请先发送短信验证码');
        }
        if($msg_obj->msg_code != $msg_code){
            throw new ApiExceptions('验证码错误');
        }
        if($msg_obj ->expire <time ()){
            throw new ApiExceptions('短信验证码过期了');
        }
        #写入用户表
        $rand_code = rand(1000,9999);
        $user_model = new UserModel();
        $user_model -> phone = $phone;
        $user_model -> password = md5($password . $rand_code);
        $user_model -> reg_type = $tt;
        $user_model -> ctime = time();
        $user_model -> status = 1;

        if( $user_model -> save() ){
            return $this -> success();
        }else{
            throw new ApiExceptions('注册失败,请重试');
        }
    }

}
