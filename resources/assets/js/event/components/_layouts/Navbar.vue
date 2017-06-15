<template>
  <div>
   <div id="nav-hot-fix" v-show="active"></div>
    <mt-tabbar v-model="selected" fixed v-show="active">
           
        <router-link :to="{name:'aOpen'}">         
            <mt-tab-item id="index">
                <i slot="icon" class="nav-index"></i>
                {{ trans('imall.enrolling_event') }}        
            </mt-tab-item>
        </router-link>
                   
        <mt-tab-item  id="category"><router-link :to="{name:'aClose'}">
            <i slot="icon" class="nav-category"></i>
            {{ trans('imall.end_event') }}
        </router-link></mt-tab-item>            

        <mt-tab-item id="cart"><router-link :to="{name:'cart'}">
            <i slot="icon" class="nav-cart">
                <mt-badge type="error" size="small" v-show="cartCount > 0">{{cartCount}}</mt-badge>
            </i>
            {{ trans('imall.cart') }}
        </router-link></mt-tab-item>
        
        <mt-tab-item id="usercenter"><router-link :to="{name:'usercenter'}"> 
            <i slot="icon" class="nav-usercenter"></i>
            {{ trans('imall.usercenter') }}
        </router-link></mt-tab-item> 
    </mt-tabbar>
  </div>
</template>

<script>
import { Tabbar, TabItem, Badge } from 'mint-ui';
export default{
    data(){
        return {
            selected:'',
            cartCount:0,
            active:true
        }
    },
    components:{
        Tabbar, TabItem, Badge
    },
    created(){
        this.initRoute();
        this.initCartCount();
    },
    watch:{
        '$route.name':{
            handler:function(val){
                this.routeHandler(val)
            }
        }
    },
    methods:{
        initRoute:function(){
            this.routeHandler(this.$route.name);
        },
        // 显示购物车
        initCartCount:function(){
            let count = localStorage.getItem('cartCount');
            if(count){
                this.cartCount = count;
            }
        },
        // 是否显示nav
        routeHandler:function(val){
            let activeRouteNames = ['usercenter'];//['index','category','usercenter']
            if(activeRouteNames.indexOf(val) >= 0){
                this.active = true;
            }else{
                this.active = false;
            }
            this.selected = val;
        }
    }
}
</script>
