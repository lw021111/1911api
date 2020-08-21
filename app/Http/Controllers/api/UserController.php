<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParamMsg\Error;
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
                 if(empty($phone)){
                           $err=[
                               'error'=>100,
                                "msg"=>'手机号不为空',
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
}
