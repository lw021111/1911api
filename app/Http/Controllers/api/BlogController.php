<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiExceptions;

class BlogController extends CommonController
{
    public function getImageCodeUrl(Request $request){
        $request->session()->start();
        $sid=$request->session()->getId();
        $arr['url']='http://yyapi.qxywzc.cn/showImageCode?sid='.$sid;
        $arr['sid']=$sid;
        return $this->success($arr);
    }

    public function showImageCode(Request $request){
        $sid=$request->get('sid');
        if(empty($sid)){
            throw new ApiExceptions('图片验证码输出失败');
        }
        $request->session()->setid($sid);
        $request->session()->start();


        header('Content-Type:image/png');
        $im=imagecreatetruecolor(100,30);
        $white=imagecolorallocate($im,255,255,255);
        $black=imagecolorallocate($im,0,0,0);
        imagefilledrectangle($im,0,0,399,29,$white);
        $grey=imagecolorallocate($im,128,128,128);
        $text=''.rand(1000,9999);
        $request->session()->put('img_code',$text);
        $request->session()->save();
        $font=storage_path(). '/bahnschrift.ttf';
        $i=0;
        while($i < strlen($text) ){
            imageline($im,rand(0,10),rand(0,25),rand(90,100),rand(10,25),$grey);
            imagettftext($im,20,rand(-15,15),11+20*$i,21,$black,$font,$text[$i]);
            $i++;

        }
        imagepng($im);
        imagedestroy($im);
        exit;



    }
}
