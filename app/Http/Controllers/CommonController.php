<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ApiExceptions;
<<<<<<< HEAD
use App\Model\MsgModel;
=======
use Illuminate\Support\Facades\Redis;
>>>>>>> 7e855420969ae1356c41e781edcd408b53dfba25

class CommonController extends Controller
{
    public function success($data=[],$msg='ok',$status=200){
        $arr=[
            'data'=>$data,
            'msg'=>$msg,
            'status'=>$status

        ];
        return $arr;
    }
    //检查是否缺少必要参数
    public function checkApiParam($key){
        $request=request();
        if(empty($value=$request->post($key))) {
            throw new ApiExceptions('缺少参数'.$key);
        }
        return $value;
    }

    public function sendAliMsgCode($phone,$code){
        if(env('MSG_SEND_MARK')==0){
            return true;
        }


        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "f9667861317641bc92f3524f0ff738e4";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile='.$phone.'&param=code%3A'.$code.'&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $arr=json_decode(curl_exec($curl),true);
        if($arr['return_code']=='00000'){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 根据手机号判断用户是否注册过
     * */
    public function checkUserExists( $phone ){
//        $msg_model= new MsgModel();
        $where = [
            [ 'phone' , '=' , $phone ],
            #状态4 --删除
            ['status' ,'<' , 4]
        ];
        return MsgModel::where($where) -> count();

<<<<<<< HEAD
    }
=======
    public function getCacheVersion($cache_type = 'news')
    {
        switch($cache_type){
            case 'news':
                $cache_version_key = 'news_cache_version';
                $version = Redis::get($cache_version_key);
                break;
            default:
                break;
        }

        if(empty($version))
        {
            Redis::set($cache_version_key,1);
                $version = 1;
        }
        return $version;
    }

>>>>>>> 7e855420969ae1356c41e781edcd408b53dfba25

}
