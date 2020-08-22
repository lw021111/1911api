<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParamMsg\Error;
use App\Model\User;
class UserController extends Controller
{
//登录接值
    public function login( Request $request){
//        $phone=$this->checkParamIsEmpty('phone');
//        $password=$this->checkParamIsEmpty('password');
            $password=$request['password'];
            $phone=$request['phone'];
                if(empty($phone)){
                    $err=[
                        'error'=>100,
                        "msg"=>'手机号不为空',
                    ];
                   return $err;
                }
                 if(empty($password)){
                           $err=[
                               'error'=>100,
                                "msg"=>'密码不为空',
                               ];
                                   return $err;
                    }
                //判断手机号
                $where=[
                    ['user_tel','=',$phone]
                ];
                $phones=User::where($where)->first();

                if($phones){
                     if($password!=$phones['user_pwd']){
                             $err=[
                                  "error"=>100,
                                    "msg"=>"登录失败请重新登录",
                                     ];
                                   return $err;
                    }
                    $err=[
                        "error"=>200,
                        "msg"=>"登录成功"
                    ];
                    return $err;
                }else{
                     $err=[
                        "error"=>100,
                         "msg"=>"登录失败,请重新登录"
                        ];
                        return $err;
                    }

    }
    protected function checkParamIsEmpty( $key )
        {

            # 接受客户端传递的参数
            $request_data = request() -> all();

            # 判断是否传递参数
            if( empty( $request_data[$key] ) ){

                # 给出对应的提示
                return $this -> fail( $this -> getErrorMsg( $key ), 1000 );

            }else{

                # 没有问题的时候，返回对应的值
                return $request_data[$key];
            }

        }
        /**
         * 获取对应的错误提示信息
         */
        public function getErrorMsg( $key )
        {
            $error_all = Error::MSG;

            if( isset( $error_all[$key]) ){

              $error_msg = $error_all[$key];
            }else{
                $error_msg = '出现错误了';
            }
            return $error_msg;
        }

        protected function  fail( $msg = 'fail' , $status = 1 , $data = [] )
        {
            $arr =  $this -> jsonOutPut( $status , $msg , $data );

    //        return response( $arr );
    //        return response($arr);
            echo json_encode($arr ,  JSON_UNESCAPED_UNICODE );
            exit;
        }

        private function jsonOutPut( $status , $msg , $data )
        {

            return [
                'status' => $status,
                'msg' => $msg,
                'data' => $data
            ];
        }

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
