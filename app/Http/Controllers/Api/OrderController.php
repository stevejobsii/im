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
        Log::info('request(SetAttributes)arrived.'); 
        $WechatOrderId = $id;
        $WechatOrder = WechatOrder::find($WechatOrderId);

        //判断是否存在
        if(isNullOrEmpty($WechatOrder)) {
            return "no such order";
        }

        if($WechatOrder->pay_status == '已支付') {
            return "已支付";
        }
        //商品属性
        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $WechatOrder->id,
            'detail'           => $WechatOrder->details,
            'out_trade_no'     => md5(uniqid().microtime()),
            'total_fee'        => $WechatOrder->order_amount*100,
            'notify_url'       => route('frontend.wechat.HandlePay'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $WechatOrder->openid,
        ];

        //创建订单
        $order = new Order($attributes);

        //统一下单
        $result = $this->wechat->payment->prepare($order);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            return $config = $this->wechat->payment->configForJSSDKPayment($prepayId); // 返回数组
        } else {
            return 'pay fail';
        }
         
    }


    









    //处理订单-event
    public function HandlePay() {
        $response = $this->wechat->payment->handleNotify(function($notify, $successful){

            $payMap[] = ['out_trade_no','=',$notify->out_trade_no];
            $pay = PayRepository::getByWhere($payMap)->first();

            //判断订单是否存在
            if(isNullOrEmpty($pay)) {
                return 'Order not exist.';
            }

            //判断订单是否已经支付过了
            if($pay['status'] == config('enumerations.PAY_STATUS.END_PAY')) {
                return true;
            }

            if($successful) {
                //修改支付记录状态
                $payData['status'] = config('enumerations.PAY_STATUS.END_PAY');
                $payData['pay_trade_no'] = $notify->transaction_id;

                PayRepository::setByWhere($payMap,$payData);

                //修改活动报名记录状态
                $eventJoinMap[] = ['pay_id','=',$pay->pay_id];
                $eventJoinData['status'] = config('enumerations.EVENT_JOIN_STATUS.END_PAY');

                EventJoinRepository::setByWhere($eventJoinMap,$eventJoinData);

                //获取报名记录
                $eventJoin = EventJoinRepository::getByWhere($eventJoinMap)->first();

                //查找活动
                $event = EventRepository::find($eventJoin['event_id']);

                //获取报名总人数
                $totalJoinMap[] = ['event_id', '=', $eventJoin['event_id']];
                $totalJoinMap[] = ['status', '=', config('enumerations.EVENT_JOIN_STATUS.END_PAY')];

                $totalJoinCount = EventJoinRepository::getByWhere($totalJoinMap)->count();


                //更新报名人数
                $eventData["join_number"] = $event["join_number"] + 1;
                EventRepository::saveById($event['event_id'],$eventData);

                //判断并修改活动状态
                if($totalJoinCount == $event['upper_limit']) {
                    $eventData['status'] = config('enumerations.EVENT_STATUS.FULL');
                    EventRepository::saveById($event['event_id'],$eventData);
                }
            }

            return true; // 或者错误消息

        });

        return $response; // Laravel 里请使用：return $response;
    }
 
}


