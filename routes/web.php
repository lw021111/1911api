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

Route::get('/', function () {
<<<<<<< HEAD
    return view('welcome');
});

//新闻列表接口
Route::any('newsList','api\NewsController@newsList');
=======
    phpinfo();
});
>>>>>>> c817299379ba94a3667eb0d685cbd169d007b341
//后端首页
Route::prefix('/api')->group(function(){
    Route::any('/index','Admin\AdminController@index');   //首页
    Route::any('/lyear','Admin\AdminController@lyear');   //后端首页
    Route::any('/lanmu','Admin\AdminController@lanmu');   //全部栏目
    Route::any('/lanmu_add','Admin\AdminController@lanmu_add');   //添加栏目
});
<<<<<<< HEAD
=======

Route::any('showImageCode','api\BlogController@showImageCode');
Route::any('getImgUrl','api\BlogController@getImageCodeUrl');
Route::any('sendMsgCode','api\MsgController@sendMsgCode');

>>>>>>> c817299379ba94a3667eb0d685cbd169d007b341
