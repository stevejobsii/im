<template>
  <div>
    <mt-navbar class="order-list-nav" v-model="selected" fixed >

        <mt-tab-item id="all" @click.native="goTo('all')">{{ trans('imall.all_order') }}</mt-tab-item>
        <mt-tab-item id="unpay" @click.native="goTo('unpay')">{{ trans('imall.unpay_order') }}</mt-tab-item>
        <mt-tab-item id="unreceived" @click.native="goTo('unreceived')">{{ trans('imall.paid_order') }}</mt-tab-item>

    </mt-navbar>
    <div id="order-list-part" v-data-scroll="loadPageData">
        <router-link tag='div' class="order-list-container"
             v-for="order in orders"
             :to="{name:'order-detail',params:{'hashid':order.id}}">
            <div class="order-info">
                <!-- <p v-show="order.pay_status === '未支付'"> --><p><span class="title">状态：</span>{{order.pay_status}}</p>
                <!-- <p v-show="order.pay_status === '已支付'">
                <span class="title">状态：</span>{{order.ship_status}}</p> -->
                <p><span class="title">总价：</span>&yen;{{order.order_amount | transformPrice}}</p>
            </div>
            <div class="order-detail" v-for="detail in order.details">
                <img :src="detail.commodity_img" v-bind:alt="detail.commodity_name"/>
                <p>{{detail.commodity_name}}</p>
                <p class="title">{{detail.buy_number}}件</p>
            </div>
        </router-link>
    </div>
    <div id="data-scroll-loading" v-show="isLoading">
        <mt-spinner type="snake" color="#09bb07" :size="15"></mt-spinner>
    </div>
    <div id="data-scroll-end" v-show="isEnd">
        没有更多订单了:)
    </div>
  </div>
</template>
<style scoped>
.order-list-nav > .mint-tab-item.is-selected{
  color: #09bb07;
  border-bottom: 3px solid #09bb07;
}
.mint-tab-item {
  color: #333;
  text-decoration: none;
}
</style>
<script>
    import { Navbar, TabItem, Spinner, Indicator, Toast } from 'mint-ui';
    export default{
        data(){
            return {
                order_type:this.$route.params.type,
                paginate:{},
                orders:[],
                isLoading:false,
                isEnd:false,
            }
        },
        components:{
            Navbar,TabItem,Spinner,Indicator,Toast
        },
        created(){
            this.fetchOrders();
        },
        methods:{
            goTo: function(path){
                //alert(path);
                this.$router.push({name:'order-list',params:{'type': path}})
            },
            fetchOrders:function(){
                let vm = this;
                let order_type = vm.$route.params.type;
                Indicator.open();
                vm.$http.get('/api/eventorderlist/'+order_type).then(response=>{
                    Indicator.close();
                    if(response.data.message.data.length === 0){
                        Toast({
                              message: '没有符合的订单数据'
                        });
                    }else{
                        vm.paginate = response.data.message;
                        vm.orders = response.data.message.data;
                    }
                });
            },
            // 数据列表5页一张，满则下一张
            loadPageData:function(){
                let vm = this;
                let page = vm.paginate.current_page + 1;
                let triggerDistance = 100;
                let distance = document.querySelector("#order-list-part").getBoundingClientRect().bottom - window.innerHeight;
                if(!vm.isLoading && !vm.isEnd && vm.paginate.data.length && distance < triggerDistance){
                    vm.isLoading = true;
                    vm.$http.get('/api/eventorderlist/'+vm.order_type+'?page='+page).then(response=>{
                        if(response.data.message.data.length === 0){
                            vm.isLoading = false;
                            vm.isEnd = true;
                        }else{
                            vm.paginate = response.data.message;
                            vm.orders = vm.orders.concat(response.data.message.data);
                            vm.isLoading = false;
                        }
                    });
                }
            }
        }
    }
</script>