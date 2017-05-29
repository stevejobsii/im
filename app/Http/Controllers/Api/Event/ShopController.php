<?php

namespace App\Http\Controllers\Api\Event;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\eventfacades\EventCommodity;
use App\eventfacades\ShopConfig;

class ShopController extends Controller
{
    
    // 如https://goodgoto.com/api/eventcommodity/1 API获取第一个活动信息
    public function getCommodity($id){
        $commodity = EventCommodity::find($id);
        if ($commodity && $commodity->event_disabled === '已上架') {
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

    // 
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
            $commodity = EventCommodity::find($item[0]);
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
 
    // 获得eventlist
    public function getCommodityByStatus(Request $request)
    {
        $status = $request->input('status');
        $response = [];
        $all = EventCommodity::where('status', '=', $status)->get();
        if ($all) {
            $response = $all;//->commodities()->get();
        }
        return response()->json($response);
    }

    public function shopconfig(){
        $config = ShopConfig::first();
        return response()->json($config);
    }
}
