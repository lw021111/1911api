<?php

namespace App\ParamMsg;

/**
 * 接口相关的错误提示信息
 * Class Error
 * @package App\Param
 */
class Error
{

    # 接口相关的错误提示信息
    const MSG = [

        # 账户名为空的时候的提示信息
        'user_name' => '用户名字不能为空',

        # 密码为空的时候的提示信息
        'password' => '你还没有输入密码呢',

        # 用户不存在的提示信息
        'user_not_exists' => '账号没有找到',

        'user_not_check' => '你的账号还没有审核通过',

        'user_is_lock' => '你的账号被锁定了，联系客服解锁',

        'user_is_del' => '你要登陆的账号不存在',

        'user_password_not_match' => '账号密码不匹配，请重试',

        'tt' => '请选择你要登陆的终端类型',

        'many_login_success' => '登陆太过频繁，稍等一会再试试',

        'password_error' => '你的账号已经输错%s次，错误5次账号会被锁定2小时',

        'user_lock_two_hour' => '你的账号已经被锁定，请在%s后再试',

        'phone' => '请输入你的手机号',

        'sid' => '验证码错误1',

        'image_code' => '请输入图片验证码',

        'phone_already_exists' => '手机号已经存在了',

        'image_code_error' => '图片验证码输入错误',

        'send_more_message' => '一天最多发送10条',

        'message_one_minute_limit' => '短信发送太过频繁',

        'message_send_error' => '短信发送失败,MYSQL插入失败',

        'message_send_error2' => '短信发送失败，请检查～',

        'mcode' => '短信验证码不能为空',

        'message_code_expire' => '短信验证码已过期(2分钟)',

        'message_code_error' => '短信验证码不正确',

        'register_fail' => '注册失败，请重试',

        'not_login' => '你还没有登陆呢，先登陆',

        'token_expire' => '你的token已经过期了，请重新登陆',

        'token_error' => 'token错误，可能是在其他地方登陆，请重试。',

        'image_type' => '请指定上传的图片格式',

        'image_type_error' => '不允许上传该图片格式',

        'image_base64_encode' => '要上传的图片不能为空',

        'goods_id' => '商品id不能为空',

        'goods_id_error' => '商品id不正确',

        'goods_not_found' => '没有找到要查看的商品'
    ];
}










