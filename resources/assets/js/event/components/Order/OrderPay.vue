<template>
    <div id="pay-order-container">
        <div class="order-title">
            <img src="/images/common/wechat_pay.png"/>
        </div>
        <div class="order-content">
            <p>所需运费：<span class="amount">&yen;{{order.freight_amount | transformPrice}}</span></p>
            <p>商品总价：<span class="amount">&yen;{{order.commodity_amount | transformPrice}}</span></p>
            <p>订单总价：<span class="amount">&yen;{{order.order_amount | transformPrice}}</span></p>
        </div>
    </div>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return {
                order:{},
                visible:false
            }
        },
        created(){
            this.fetchOrder();
        },
        methods:{
            fetchOrder: function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/eventorder/'+itemId).then(response=>{
                    Indicator.close();
                    if(response.data.code == 0){
                        vm.$set('order',response.data.message);
                        Indicator.open('发起支付中...');
                        vm.wechatPay();
                        Indicator.close();
                    }else{
                        Toast({
                            message: response.data.message
                        });
                    }
                });
            },
            wechatPay: function(){
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/SetAttributes/'+itemId).then(response=>{
                    let json = response.data;
                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',json,
                            function(res){     
                                switch(res.err_msg) {
                                    case 'get_brand_wcpay_request:cancel':
                                        alert('用户取消支付！');
                                        window.location.href = "https://goodgoto.com/event#!/usercenter"; 
                                        break;
                                    case 'get_brand_wcpay_request:fail':
                                        alert('支付失败！（'+res.err_desc+'）');
                                        window.location.href = "https://goodgoto.com/event#!/usercenter"; 
                                        break;
                                    case 'get_brand_wcpay_request:ok':
                                        alert('支付成功!good');
                                        window.location.href = "https://goodgoto.com/event#!/usercenter"; 
                                        break;
                                    default:
                                        alert(JSON.stringify(res));
                                        window.location.href = "https://goodgoto.com/event#!/usercenter"; 
                                        break;
                                } 
                            }
                    );

                });
            }
        }
    }

</script>