<template>
  <div>
    <img class="commodity-img"  :src="commodity.event_img"/>
    <div id="commodity-container">
        <p class="name">{{commodity.event_name}}</p>
        <p class="name">(主办方:{{commodity.manager}}、地点:{{commodity.event_place}})</p>
        <p class="price">
            日期:{{commodity.end_time}}({{commodity.status}})
        </p>
        <p class="price">
            &yen;{{commodity.event_current_price | transformPrice}}&emsp;
            <del>&yen;{{commodity.event_original_price | transformPrice}}</del>
            <span v-show="commodity.status === '报名中'" >剩余：{{commodity.event_stock_number}}件</span>
        </p>
    </div>
    
    <div  v-show="commodity.status === '报名中'" id="number-container">
        <p>数量：</p>
        <div class="num-wrap">
            <span class="minus-btn"
                  :class=" commodity_num > 1 ? 'active' : '' "
                  @click="minusClick(commodity_num)">
            </span>
            <input class="num" type="tel" v-model="commodity_num">
            <span class="plus-btn active" @click="plusClick(commodity_num)">
            </span>
        </div>
    </div>

    <div id="detail-container">
        <ul class="title-wrap">
            <li @click="detailToggle"
                :class=" detailVisible ? 'active' : '' ">
                活动详情
            </li>
            <li @click="detailToggle"
                :class=" detailVisible ? '' : 'active' ">
                活动简介
            </li>
        </ul>
        <div class="detail-wrap" v-show="detailVisible"
            v-html="commodity.event_detail_info">
        </div>
        <div class="base-wrap" v-show="!detailVisible"
            v-html="commodity.event_base_info | rnTransform">
        </div>
    </div>
    <div style="width:100%;height:60px;"></div>
    <div id="btn-groups-container">
        <router-link tag='div' class="cart-wrap" :to="{name:'cart'}">
            <mt-badge
                    type="error"
                    size="small"
                    v-show="cartCount > 0">
                {{cartCount}}
            </mt-badge>
        </router-link>
        <div  v-show="commodity.status === '报名中'" class="add-cart-btn" @click="addCart">加入购物车</div>
        <div  v-show="commodity.status === '报名中'" class="to-pay-btn" @click="toPay">立即购买</div>
    </div>
  </div>
</template>

<style scoped>
    #commodity-detail-btn-group{
        position:fixed;
        bottom:0;
        left:0;
        width:200px;
        height:50px;
    }
</style>
<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    import { Badge } from 'mint-ui';
    export default{
        data(){
            return {
                commodity:'',
                sheetVisible:false,
                detailVisible:true,
                commodity_num:1,
                cartCount:0,
            }
        },
        components:{
            Badge
        },
        created(){
            this.fetchCommodity();
        },

        methods:{
            // ok
            fetchCommodity:function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/eventcommodity/'+itemId).then(function(response){
                    Indicator.close();
                    if(response.data.code == 0){
                        let commodity = response.data.message;
                        vm.commodity = commodity;
                        vm.fetchCartCount();
                    }else{
                        Toast({
                          message: response.data.message
                        });
                        vm.$router.push('/category');
                    }
                });
            },
            // 购物车数量
            fetchCartCount:function(){
                let vm = this;
                vm.$http.get('/api/eventcart/count').then(function(response){
                    if(response.data.code == 0){
                        vm.cartCount = response.data.message;
                    }
                });
            },
            minusClick: function(num){
                (num > 1) &&  this.$set('commodity_num',num-1);
            },
            plusClick: function(num){
                this.$set('commodity_num',num+1);
            },
            detailToggle: function(){
                this.detailVisible = !this.detailVisible;
            },
            addCart: function(){
                Indicator.open();
                let vm = this;
                vm.$http.post('/api/eventcart',{
                        commodity_id:vm.commodity.id,
                        commodity_num:vm.commodity_num
                    }).then(function(response){
                        Indicator.close();
                        if(response.data.code == 0){
                            if(response.data.extra == 'store'){
                                vm.cartCount = vm.cartCount + 1;
                            }
                        }
                        Toast({
                            message: response.data.message
                        });
                    });
            },
            toPay: function(){
                let commodity = this.commodity.id+ '-' + this.commodity_num;
                let order = {from:'default',commodity:commodity};
                this.$router.push({name:'order-settle',query:order});
            }
        }
    }

</script>