<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatAddress;
use App\ProductCommodity;
use App\WechatOrder;
use App\eventfacades\WechatOrder;
use App\WechatOrderDetail;
use App\ShopConfig;
use App\WechatCart;
use Validator;
use Log;
use EasyWeChat\Payment\Order;
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
    // 获取商品订单订单详情
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

    // 获取活动订单订单详情
    public function event_detail($id)
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
        
        //查找商品
        Log::info('request(SetAttributes)arrived.'); 
        $WechatOrderId = $id;
        $WechatOrder = WechatOrder::find($WechatOrderId);

        //判断是否存在
        if(isNullOrEmpty($WechatOrder)) {
            return redirect()->route('frontend.wechat.index');
        }

        //判断是否已经支付
        if($WechatOrder->pay_status == '已支付') {
            return "已支付";
        }

        //商品属性
        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $WechatOrder->id,
            'detail'           => $WechatOrder->id,
            //订单的标签order_number
            'out_trade_no'     => $WechatOrder->order_number,
            'total_fee'        => $WechatOrder->order_amount*100,
            'notify_url'       => "https://goodgoto.com/HandlePay", 
            // 支付结果通知网址，如果不设置则会使用配置里的默认地址 route('frontend.wechat.HandlePay')
            'openid'           => $WechatOrder->openid,
        ];

        //创建订单
        $order = new Order($attributes);

        //统一下单
        $result = app('wechat')->payment->prepare($order);
        Log::info($result);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            //不需要再修改configForJSSDKPayment了
            $config = app('wechat')->payment->configForJSSDKPayment($prepayId);
                 $config['timeStamp'] = $config['timestamp'];
                 unset($config['timestamp']); // 返回数组
                 //$config['notify_url'] = "https://goodgoto.com/HandlePay";
        Log::info($config);
        Log::info('request(SetAttributes)out.'); 
            return $config;
        } else {
        Log::info('request(SetAttributesfail)out.'); 
            return 'pay fail';
        }
         
    }

    //处理订单信息,这个是微信发出的
    public function HandlePay() {
        Log::info('request(HandlePay)arrived.'); 
        $response = app('wechat')->payment->handleNotify(function($notify, $successful){
            // LOG debug
            // Log::info($notify); 
            // Log::info($successful);
            
            // 查找对应的order
            $WechatOrder = WechatOrder::where('order_number','=',$notify->out_trade_no)->first();
            //Log::info($WechatOrder);

            if(isNullOrEmpty($WechatOrder)) {
                return 'Order not exist.';
            }
            
            // 判断是否已经支付
            if($WechatOrder['pay_status'] == '已支付') {
                return 'Order has already paid.';
            }

            // order录入已经支付
            if($successful) {
                //修改支付记录状态
                $WechatOrder['pay_status'] = '已支付';
                $WechatOrder->save(); 
            }

            // TODO 库存减相应件数
            if($successful) {
                //Log::info($WechatOrder->detail);
                //$WechatOrder->save(); 
            }

            return true; 
        });

        return $response; // Laravel 里请使用：return $response;
    }
 
}


