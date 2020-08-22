<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //接口展示
    public function  blog_list(){
        return view('api/blog_list');
    }

    public function getImageCodeUrl(){

    }

    /*
     * test
     * */
    public function test(){
        harder('Content-Type : image/png');

        //Create the image
        $im = imagecreatetruecolor(100 ,30);
         //Create some colors
        $white = imagecolorallocate($im , 225 , 255 , 255);
        $black = imagecolorallocate($im ,0,0,0);
        imagefilledrectangle($im , 0 ,0 , 399 , 29 , $white);
        $grey = imagecolorallocate($im ,128,128,128);

        //the text to draw
        $text = ''.rand(1000,9999);
        //Replace path by your own font path
        $font = storage_path().'FiraCode-Regular.ttf';

        //Add some shadow to the text
        $i = 0;
        while ($i <strlen ($text)){
            imageline($im ,rand(0,100),rand(0,3),rand(0,100),rand(0,3),$grey);
            imagettftext($im ,20,rand(-15,-15), 11+20*$i , 21 ,$black ,$font , $text[$i]);
            $i++;
        }
        //Using imagepng() results in clearer text compared with imagejpeg()
        imagepng($im);
        imagedestroy($im);;
        exit;
    }
}
