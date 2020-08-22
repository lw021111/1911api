<?php

namespace App\Http\Controllers\api;

use App\Exceptions\ApiExceptions;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\MsgModel;

class MsgController extends CommonController
{
    public $msg_expire = 60;

    //
    public function sendMsgCode(Request $request)
    {

        //发送短信
        $sid = $this->checkApiParam('sid');
        $phone = $this->checkApiParam('phone');
        $img_code = $this->checkApiParam('user_img_code');
        $type = $this->checkApiParam('type');

        //验证图片验证码是不是正确
        $request->session()->setId($sid);
        $request->session()->start();
        $session_code = $request->session()->get('img_code');

        if ($session_code != $img_code) {
            throw new ApiExceptions('图片验证码不正确');
        } else {
            $request->session()->forget('img_code');
        }
        #验证手机号是否存在
        if ($this->checkUserExists($phone) > 0) {
            throw new ApiExceptions('你的账户已经注册过了,不能在进行注册');
        }

        //发送短信验证码
        $where = [
            ['phone', '=', $phone],
            ['type', '=', $type],
        ];
        $msg_model = new MsgModel();
        $obj = $msg_model->where($where)->orderBy('msg_id', 'desc')->first();
        $msg_code = rand(100000, 999999);
        if (!empty($obj) && $obj->expire > time()) {
            throw new ApiExceptions('短信验证码发送过于频繁,请稍后再试');
        }
        //判断是否超过10条数据
        $time = strtotime(date('Y-m-d') . '00:00:00');
        $count_where = [
            ['phone', '=', $phone],
            ['ctime', '>=', $time]
        ];
        if ($msg_model->where($count_where)->count() >= 10) {
            throw new ApiExceptions('今天发送次数上限,明天再试吧');
        }
        $msg_model->phone = $phone;
        $msg_model->type = $type;
        $msg_model->msg_code = $msg_code;
        $msg_model->expire = time() + $this->msg_expire;
        $msg_model->status = 1;
        $msg_model->ctime = time();
        if ($msg_model->save()) {
            //发送短信
            if ($this->sendAliMsgCode($phone, $msg_code)) {
                return $this->success();
            } else {
                throw new ApiExceptions('发送失败,请重试');
            }

        }

    }
}
