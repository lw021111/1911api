<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\model\NewsModel;
use App\model\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;



/**
 * 新闻 相关接口
 * Class NewsController
 * @package App\Http\Controllers\api
 */
class NewsController extends CommonController
{
     /*
     * 热点资讯
     */
    public function wifiList(Request $request){
         //接口page和pagesize参数
         $page = $request ->post('page')??1;
         $page_size = $request -> post('page_size')??10;

         $news_model = new NewsModel();

          //只查询已发布的数据
          $where = [
             ['news_news.status','=',3]
          ];

          $count=$news_model::where($where)
          ->orderBy('comment_count',"desc")
          ->limit(5)
          ->get();



          return $this->success($count);

    }


    /*
     * 新闻详情接口
     */
    public function newsDetail(Request $request){
    //接收前台传过来的新闻ID
        $news_id=$this->checkApiParam('news_id');
       //根据新闻表查询一条数据
       $where=[
        ["news_news.news_id","=",$news_id]
       ];
       $news=NewsModel::with('getCate')
                         ->join('news_cate','news_cate.cate_id','news_news.cate_id')
                         ->where($where)
                         ->with("getCate")
                         ->first();
//                $news = collect($news)->toArray();
//                dd($news);
        $news->news_image = env('IMG_HOST').$news->news_image;
//        dd($news);
       return $this->success($news);
    }


    /*
     * 新闻列表接口
     */
    public function newsList(Request $request)
    {

        //接口page和pagesize参数
        $page = $request ->post('page')??1;
        $page_size = $request -> post('page_size')??10;

        $news_model = new NewsModel();

        //拼接缓存的key
        $page_key = 'index_list_'.$page;
        $page_key .= '_'.$this->getCacheVersion('news');

        //查询缓存是否有数据
        if($id_list = Redis::get($page_key))
        {
//            dump('1取redis');
            $id_arr = unserialize($id_list);
//            var_dump($id_arr);
            $list = $this->getListCache($id_arr);
            return $this->success($list);
        }


        //只查询已发布的数据
        $where = [
            ['news_news.status','=',3]
        ];

        //按照发布时间倒序
        $order_field = 'publish_time';
        $order_type = 'desc';

        $news_list_obj = NewsModel::with('getCate')
            ->join('news_cate','news_cate.cate_id','news_news.cate_id')
            ->where($where)
            ->with("getCate")
            ->orderBy($order_field,$order_type)
            ->paginate($page_size);
//            dd($news_list_obj);
        if(!empty($news_list_obj))
        {
            foreach($news_list_obj as $k=>$v)
            {
                $v->news_image = env('IMG_HOST').$v->news_image;
            }
        }
        $news_list = collect($news_list_obj)->toArray();

        //根据列表数据生成原子缓存 按照详情数据缓存
        if(!empty($news_list))
        {
//            echo '2存redis';
            $this->buildNewsDetailCache($news_list['data']);
        }

        //查到的数据生成缓存写入redis
        $this->buildNewsListCache($page_key,$news_list['data']);

        return $this->success($news_list['data']);
    }
    /*
     * 根据列表数据生成情数据缓存
     */
    public function buildNewsListCache($page_key,$news_list)
    {
//        dd($news_list);exit;
        $id_arr = array_column($news_list,'news_id');
//        dd($id_arr);
        if(Redis::set($page_key,serialize($id_arr))){
            Redis::expire($page_key,60 * 5);

            return true;
        }else{
            return false;
        }
    }

    /**
     * 根据列表数据生成详情缓存a
     */
    public function buildNewsDetailCache($news_list)
    {

        foreach($news_list as $k=>$v)
        {
            $v['cate_name'] = $v['get_cate']['cate_name'];
            $detail_key = 'news_detail_'.$v['news_id'];
            Redis::hMset($detail_key , $v);
            Redis::expire($detail_key,60 * 5);

        }
        return true;
    }

   public function getListCache($id_arr)
       {
           $all = [];
           foreach($id_arr as $k=>$v)
           {
               $detail_key = 'news_detail_'.$v;
               $detail = Redis::hGetAll($detail_key);
               if(empty($detail))
               {
                   $detail_obj = NewsModel::with('getCate')->find($v);
                   $detail_obj->cate_name = $detail_obj->getCate->cate_name;
                   $detail = collect($detail_obj)->toArray();
                   Redis::hMset($detail_key,$detail);
                   $all[] = $detail;
               }else{
                   $all[] = $detail;
               }

           }
           return $all;
       }
}
