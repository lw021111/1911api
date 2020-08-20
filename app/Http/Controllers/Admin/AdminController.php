<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //后端首页
    public function index(){
        return view('admin/index');
    }
    //跳转
    public function lyear(){
        return view('admin/lyear_main');
    }
    //跳转栏目
    public function lanmu(){
        return view('admin/lanmu');
    }
    //添加栏目
    public function lanmu_add(){
        return view('admin/lanmu_add');
    }

}
