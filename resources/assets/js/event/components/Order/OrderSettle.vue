<template>
  <div>
    <div id="to-pay-container" v-show="!choosing">
        <!-- event项目不需要邮寄地址 -->
        <!-- <div class="address-wrap">
            <div class="address-default">
                <span>收货地址</span>
                <ul v-show="address != ''"
                    @click="chooseAddress">
                    <li>
                        {{address.province}}{{address.city}}{{address.district}}{{address.address}}
                    </li>
                    <li>
                        {{address.name}} {{address.phone | transformPhone}}
                    </li>
                </ul>
                <ul v-show="address == ''"
                    :to="{name:'add-address'}">
                    <li>
                        送至...
                    </li>
                    <li>
                        还未新建地址，点击新建
                    </li>
                </ul>
            </div>
        </div> -->
        <div class="address-wrap">
        </div>
        <div id="cart-container">
            <section class="cart-wrap" v-for="good in goods">
                <i class="select-one-btn selected">
                </i>
                <a class="img-wrap">
                    <img :src="good.event_img"/>
                    <p class="name">{{good.event_name}}</p>
                </a>
                <div class="price-wrap">
                    <span class="commodity-result">
                            <span>&yen;{{good.event_current_price | transformPrice}}</span> *
                            <span class="num">{{good.cart_num}}</span> =
                            <span class="price">&yen;{{good.event_current_price * good.cart_num | transformPrice}}</span>
                    </span>
                </div>
            </section>
        </div>
        <div id="pay-container">
            <div class="total-result">
                <p class="total-price">总计：&yen;{{totalPrice | transformPrice}}</p>
                <!-- <p v-if="freight_amount">
                    （订单未满￥{{shopConfig.config_free | transformPrice}}，
                     需额外支付邮费￥{{shopConfig.config_freight | transformPrice}}）
                </p>
                <p v-else>（订单已满￥{{shopConfig.config_free | transformPrice}}，无需邮费）</p> -->
            </div>
            <div class="to-pay-btn"
                 @click="payOrder">
                去结算
            </div>
        </div>
    </div>
    <!-- <address-choose
            :choosed.//sync="address"
            :visible.//sync="choosing">
    </address-choose> -->
  </div>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    import { MessageBox } from 'mint-ui';
    //import AddressChoose from '../Address/AddressChoose.vue';
    export default{
        data(){
            return {
                from: '',
                goods: [],
                //address:{},
                choosing: false,
                totalPrice:0,
                freight_amount:false,
                shopConfig:{}
            }
        },
        components:{
            //AddressChoose
        },
        created(){
            this.initOrder();
        },
        methods:{
            initOrder: function(){
                Indicator.open();
                let vm  = this;
                let query = vm.$route.query;
                //vm.fetchDefaultAddress();
                vm.from = query.from;
                query.from == 'cart' ? vm.fetchGoodsFromCart(query.cartIds,query.commodities)
                                     : vm.fetchGoods(query.commodity);
                Indicator.close();
            },
            // fetchDefaultAddress: function(){
            //     let vm = this;
            //     vm.$http.get('/api/default/address').then(function(response){
            //         if(response.data.code == 0){
            //             vm.$set('address',response.data.message);
            //             if(vm.address == ''){
            //                 MessageBox.confirm('还未建立收货地址，马上去新建?').then(action => {
            //                     vm.$router.push('/add-address');
            ////go
            //                 });
            //             }
            //         }
            //         Indicator.close();
            //     });
            // },
            // fetch form commoditydetail 立即购买
            fetchGoods: function(commodity){
                let vm = this;
                let data = commodity.split('-');
                let itemId = data[0];
                let cart_num = data[1];
                vm.$http.get('/api/eventcommodity/'+itemId).then(response=>{
                    if(response.data.code == 0){
                        let goods = response.data.message;
                        goods.cart_num = cart_num;
                        vm.goods.push(goods);
                        vm.$nextTick(function(){
                            vm.calculatePrice();
                        });
                    }else{
                        Toast({
                              message: response.data.message
                        });
                    }
                });
            },
            // fetch form cart
            fetchGoodsFromCart: function(cartIds,commodities){
                let vm = this;
                vm.$http.get('/api/eventcommodities/'+commodities).then(response=>{
                    if(response.data.code == 0){
                         vm.goods = response.data.message;
                        vm.$nextTick(function(){
                            vm.calculatePrice();
                        });
                    }else{
                        Toast({
                              message: response.data.message
                        });
                    }
                });
            },
            // chooseAddress: function(){
            //     this.choosing = !this.choosing;
            // },
            calculatePrice: function() {
                let price = 0;
                this.goods.forEach(function(value){
                    price += value.event_current_price * value.cart_num;
                });
                this.totalPrice = price;
                let shopCacheConfig = localStorage.getItem('shopConfig');
                let shopConfig = JSON.parse(shopCacheConfig);
                this.shopConfig = shopConfig;
                price < shopConfig.config_free ? this.freight_amount = shopConfig.config_freight
                                                : this.freight_amount = false;
                Indicator.close();
            },
            // 创建订单order
            payOrder: function(){
                Indicator.open({
                  text: '订单创建中...'
                });
                let vm = this;
                let data = {};
                // 订单来源
                data.from = vm.from;
                // 地址数据
                // data.name = vm.address.name;
                // data.phone = vm.address.phone;
                // data.province = vm.address.province;
                // data.city = vm.address.city;
                // data.district = vm.address.district;
                // data.address = vm.address.address;
                // 商品数据
                data.commodity = this.goods;
                 // Toast({
                 //          message: data
                 //        });
                //创建订单
                vm.$http.post('/api/eventorder',data).then(response=>{
                      // Toast({
                      //     message: response.data
                      //   });
                    Indicator.close();
                    if(response.data.code == 0){
                        vm.$router.push({name:'orderpay',params:{'hashid':response.data.message}});
                    }else{
                        Toast({
                          message: response.data.message
                        });
                    }
                });
            },

        }
    }
</script>