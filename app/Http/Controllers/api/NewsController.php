<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Model\NewsModel;
use Illuminate\Http\Request;

/**
 * 新闻 相关接口
 * Class NewsController
 * @package App\Http\Controllers\api
 */
class NewsController extends Controller
{
    /*
     * 新闻列表接口
     */
    public function newsList(Request $request)
    {
        //接口page和pagesize参数
        $page = $request ->post('page')??1;
        $page_size = $request -> post('page_size')??10;

        $news_model = new NewsModel();

        //只查询已发布的数据
        $where = [
            ['status','=',3]
        ];
        //按照发布时间倒序
        $order_field = 'publish_time';
        $order_type = 'desc';

        $news_list_obj = $news_model
            ->where($where)
            ->orderBy($order_field,$order_type)
            ->paginate($page_size);
        $news_list = collect($news_list_obj)->toArray();
        return $this->success($news_list['data']);

    }
}
