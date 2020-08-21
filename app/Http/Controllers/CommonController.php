<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ApiExceptions;
use Illuminate\Support\Facades\Redis;

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
        $appcode = "0c79d4fb52d74c48ad535aefee17fb35";
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


}
