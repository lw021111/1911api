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
    return view('welcome');
});

//新闻列表接口
Route::any('newsList','api\NewsController@newsList');
//后端首页
Route::prefix('/api')->group(function(){
    Route::any('/index','Admin\AdminController@index');   //首页
    Route::any('/lyear','Admin\AdminController@lyear');   //后端首页
    Route::any('/lanmu','Admin\AdminController@lanmu');   //全部栏目
    Route::any('/lanmu_add','Admin\AdminController@lanmu_add');   //添加栏目
});
