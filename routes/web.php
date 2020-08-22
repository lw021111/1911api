<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//登录接口
Route::any("login","api\UserController@login");


//新闻列表接口

Route::any('/newsList','api\NewsController@newsList');


Route::get('/', function () {
    phpinfo();
});

//后端首页
//后端首页1

Route::prefix('/api')->group(function(){
    Route::any('/index','Admin\AdminController@index');   //首页
    Route::any('/lyear','Admin\AdminController@lyear');   //后端首页
    Route::any('/lanmu','Admin\AdminController@lanmu');   //全部栏目
    Route::any('/lanmu_add','Admin\AdminController@lanmu_add');   //添加栏目
    Route::any('/blog_list','Admin\BlogController@blog_list');   //接口展示1
});





//展示图片验证码
Route::any('showImageCode','api\BlogController@showImageCode');

Route::any('getImgUrl','api\BlogController@getImgUrl');

//获取图片验证码
//Route::any('getImgUrl','api\BlogController@getImageCodeUrl');
//发送短信验证码

Route::any('sendMsgCode','api\MsgController@sendMsgCode');
//注册接口
Route::any('reg','api\UserController@reg');





