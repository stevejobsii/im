<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatAddress;
use App\ProductCommodity;
use App\WechatOrder;
use App\WechatOrderDetail;
use App\ShopConfig;
use App\WechatCart;
use Validator;
use Log;
//use App\Helpers\Helper;

class OrderController extends Controller
{
    protected $follow;

    public function __construct()
    {
        $this->follow = session('wechat.oauth_user');
    }

    /**
     * 生成订单号
     * @return string
     */
    private function build_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    public function store(Request $request)
    {
        // TODO validator
        $openid = $this->follow->id;
        $from = $request->from;
        $order = new WechatOrder;
        $order->openid = $openid;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->province = $request->province;
        $order->city = $request->city;
        $order->district = $request->district;
        $order->address = $request->address;
        $goods = $request->commodity;
        // 查询商品基础运费设置信息
        $shop_config = ShopConfig::first();
        // 计算商品总价
        $commodity_amount = 0.00;
        foreach ($goods as $item) {
            $commodity_amount += $item['commodity_current_price'] * $item['cart_num'];
        }
        // 若不满足包邮价格，计算所需邮费
        $freight_amount = 0.00;
        if ($shop_config && $commodity_amount < $shop_config->config_free) {
            $freight_amount = $shop_config->config_freight;
        }
        // 计算订单总价
        $order_amount = $commodity_amount + $freight_amount;
        $order->commodity_amount = $commodity_amount;
        $order->freight_amount = $freight_amount;
        $order->order_amount = $order_amount;
        $order->order_number = $this->build_order_no();

        // 记录订单表，并插入订单明细表
        if ($order->save()) {
            foreach ($goods as $item) {
                $detail = new WechatOrderDetail;
                $detail->order_id = $order->id;
                $detail->openid = $openid;
                $detail->commodity_id = $item['id'];
                $detail->commodity_name = $item['commodity_name'];
                $detail->commodity_img = $item['commodity_img'];
                $detail->commodity_number = $item['commodity_number'];
                $detail->commodity_original_price = $item['commodity_original_price'];
                $detail->commodity_current_price = $item['commodity_current_price'];
                $detail->buy_number = $item['cart_num'];
                $detail->save();
                // 若为购物车订单来源，则删除对应购物车记录
                if ($from == 'cart') {
                    WechatCart::where('openid', '=', $openid)
                        ->where('commodity_id', '=', $item['id'])
                        ->delete();
                }
            }
            return response()->json([
                'code' => 0,
                'message' => $order->id
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '订单创建失败！'
            ]);
        }
    }

    public function show($id)
    {
        $openid = $this->follow->id;
        $order = WechatOrder::where('id', '=', $id)
            ->where('openid', '=', $openid)->first();
        if ($order) {
            return response()->json([
                'code' => 0,
                'message' => $order
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该订单不存在！'
            ]);
        }
    }

    public function index($type)
    {
        $openid = $this->follow->id;
        $page_size = 5;
        switch ($type) {
            case 'all':
                $orders = WechatOrder::with('details')
                    ->where('openid', '=', $openid)
                    ->orderBy('id', 'desc')
                    ->paginate($page_size);
                break;
            case 'unpay':
                $orders = WechatOrder::with('details')
                    ->where('openid', '=', $openid)
                    ->where('pay_status', '=', '未支付')
                    ->orderBy('id', 'desc')
                    ->paginate($page_size);
                break;
            case 'unreceived':
                $orders = WechatOrder::with('details')
                    ->where('openid', '=', $openid)
                    ->where('pay_status', '=', '已支付')
                    ->whereIn('ship_status', ['未发货', '已发货'])
                    ->orderBy('id', 'desc')
                    ->paginate($page_size);
                break;
            default:
                break;
        }
        return response()->json([
            'code' => 0,
            'message' => $orders
        ]);
    }

    public function detail($id)
    {
        $order = WechatOrder::find($id);
        if ($order) {
            $order = WechatOrder::with('details')->find($id);
            return response()->json([
                'code' => 0,
                'message' => $order
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '订单不存在'
            ]);
        }
    }

    //订单下单
    public function SetAttributes($id, Request $request) {
        //查找event
        Log::info('request(SetAttributes) arrived.'); 
        $WechatOrderId = $id;
        $WechatOrder = WechatOrder::find($WechatOrderId);

        //判断是否存在
        if(isNullOrEmpty($WechatOrder)) {
            //return redirect()->route('frontend.event.eventList');
            return "no such order";
        }

        return $WechatOrder;
        // //查找用户
        // $customer = User::find($request->session()->get('customerId'));

        // //获取活动报名记录
        // $map[] = ['customer_id', '=', $request->session()->get('customerId')];
        // $map[] = ['event_id', '=', $eventId];

        // //寻找活动报名记录
        // $eventJoin = EventJoinRepository::getByWhere($map)->first();

        // //判断是否已经报名活动
        // if($eventJoin['status'] != config('enumerations.EVENT_JOIN_STATUS.WAITING_PAY')) {
        //     return redirect()->route('frontend.event.eventList');
        // }

        // //获取支付记录
        // $pay = PayRepository::find($eventJoin["pay_id"]);

        // //判断支付记录是否为空
        // if(isNullOrEmpty($pay)) {
        //     $payData['pay_type'] = config('enumerations.PAY_TYPE.WECHAT');
        //     $payData['money'] = $event['price'];
        //     $payData['status'] = config('enumerations.PAY_STATUS.WAITING_PAY');
        //     $payData['out_trade_no'] = time().rand(0, 999);

        //     $pay = PayRepository::create($payData);

        //     $eventJoinMap[] = ['join_id','=',$eventJoin['join_id']];
        //     $eventJoinData['pay_id'] = $pay['pay_id'];

        //     EventJoinRepository::setByWhere($eventJoinMap,$eventJoinData);
        // }

        //商品属性
         
    }
    /**
     * 判断是否为空
     */
 
}


