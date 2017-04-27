<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ShopBanner;
use App\ProductTopic;
use App\ProductPlate;
use App\ProductCategory;
use App\ProductCommodity;
use App\ShopConfig;

class ShopController extends Controller
{
    public function getBanners()
    {
        $banners = ShopBanner::where('disabled', '=', '1')
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($banners);
    }

    public function getTopics()
    {
        $topics = ProductTopic::where('disabled', '=', '1')
            ->orderBy('topic_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($topics);
    }

    public function getPlates()
    {
        $topics = ProductPlate::where('disabled', '=', '1')
            ->orderBy('plate_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($topics);
    }

    public function getCategories()
    {
        $parentCategories = ProductCategory::where('parent_id', '=', '0')
            ->orderBy('category_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        $categories = array();
        foreach ($parentCategories as $key => $parent) {
            $categories[$key]['parent_category'] = $parent;
            $categories[$key]['sub_categories'] = ProductCategory::where('parent_id', '=', $parent->id)
                ->orderBy('category_sort', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }
        return response()->json($categories);
    }

    public function getCommodityByTopic(Request $request)
    {
        $id = $request->input('topic_id');
        $response = [];
        $topic = ProductTopic::find($id);
        if ($topic) {
            $response = $topic->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodityByPlate(Request $request)
    {
        $id = $request->input('plate_id');
        $response = [];
        $plate = ProductPlate::find($id);
        if ($plate) {
            $response = $plate->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodityByCategory(Request $request)
    {
        $id = $request->input('category_id');
        $response = [];
        $category = ProductCategory::find($id);
        if ($category) {
            $response = $category->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodity($id){
        $commodity = ProductCommodity::find($id);
        if ($commodity && $commodity->commodity_disabled === '已上架') {
            return response()->json([
                'code' => 0,
                'message' => $commodity
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该商品已下架！'
            ]);
        }
    }

    public function getCommodities($ids){
        $ids = explode(',',trim($ids,','));
        if(!is_array($ids)){
            return response()->json(
                [
                    'code'=>-1,
                    'message'=>'未查询到商品'
                ]
            );
        }
        $commodities = [];
        foreach($ids as $item){
            $item = explode('-',$item);
            // 查询商品数据
            $commodity = ProductCommodity::find($item[0]);
            // 添加购物车所选商品数量
            $commodity->cart_num = $item[1];
            $commodities[] = $commodity;
        }
        return response()->json(
            [
                'code'=>0,
                'message'=>$commodities
            ]
        );
    }

    public function shopconfig(){
        $config = ShopConfig::first();
        return response()->json($config);
    }
}
