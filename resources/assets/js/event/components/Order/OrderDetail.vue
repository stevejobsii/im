
<template>
    <div id="order-detail-part">
        <div class="order-detail-wrapper">
            <div class="detail-container underline">
                <p class="info">感谢您在购买服务门票，欢迎您再次光临！</p>
            </div>
            <div class="detail-container">
                <p v-show="order.pay_status === '未支付'"><span class="title">状态：</span>{{order.pay_status}}</p>
                <p v-show="order.pay_status === '已支付'"><!-- <span class="title"> -->
                <!-- 状态：</span>{{order.ship_status}}</p> -->
                <p><span class="title">订单编号：</span>{{order.order_number}}</p>
                <p><span class="title">下单时间：</span>{{order.created_at}}</p>
            </div>
        </div>
        <!-- <div class="order-detail-wrapper">
            <div class="detail-container">
                <p>
                    <span class="title">收货地址：</span>
                </p>
                <p class="address">
                    {{order.province}}{{order.city}}{{order.district}}{{order.address}}
                </p>
                <p class="price"><span class="title">商品金额：</span>&yen;{{order.commodity_amount}}</p>
                <p><span class="title">收货人：</span>{{order.name}} {{order.phone | transformPhone}}</p>
                <p><span class="title">配送方式：</span>{{order.ship_name}} {{order.ship_number}}</p>

            </div>
        </div> -->
        <div class="order-detail-wrapper">
            <div class="detail-container">
                <router-link tag='div' class="commodity-list"
                     :key="detail.id"
                     v-for="detail in order.details"
                     :to="{name:'commodity',params:{'hashid':detail.commodity_id}}">
                    <img :src="detail.commodity_img" v-bind:alt="detail.commodity_name"/>
                    <div class="commodity-name">
                        <p>{{detail.commodity_name}}</p>
                        <ul>
                            <li class="price">&yen;{{detail.commodity_current_price | transformPrice}}</li>
                            <li class="number">{{detail.buy_number}}件</li>
                        </ul>
                    </div>
                </router-link>
            </div>
        </div>

        <div class="order-detail-wrapper">
            <div class="detail-container underline">
                <div class="order-result">
                    <ul>
                        <li class="result-name">
                          <p>商品总额</p>
                          <!-- <p>运费</p> -->
                        </li>
                        <li class="result-value">
                            <p class="price">&yen;{{order.commodity_amount | transformPrice}}</p>
                            <!-- <p class="price">&#43;&yen;{{order.freight_amount | transformPrice}}</p> -->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detail-container">
                <p class="result-amount">实付金额：<span class="price">&yen;{{order.order_amount | transformPrice}}</span></p>
            </div>

           <div class="order-pay-btn" v-show="order.pay_status === '未支付'" @click="payOrder">
                微信支付
           </div>
        </div>
    </div>
</template>

<script>
    import { Indicator, Toast } from 'mint-ui';
    export default{
        data(){
            return {
                order:{}
            }
        },
        components:{
            Indicator, Toast
        },
        created(){
            this.fetchDetails();
        },
        methods:{
            fetchDetails:function(){
                let vm = this;
                let itemId = this.$route.params.hashid;
                Indicator.open();
                vm.$http.get('/api/eventorderdetail/'+itemId).then(response=>{
                    Indicator.close();
                    if(response.data.code == -1){
                        Toast({
                            message:response.data.message
                        });
                    }
                    if(response.data.code == 0){
                        vm.order = response.data.message;
                    }
                });
            },
            payOrder: function(){
                Indicator.open({
                  text: '订单创建中...'
                });
                let itemId = this.$route.params.hashid;
                window.location.href = 'https://goodgoto.com/event#!/'+itemId+'/orderpay'; 
            },
        }
    }
</script>