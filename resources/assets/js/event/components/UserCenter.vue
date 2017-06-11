<template>
    <header id="uc-head-container">
        <img class="bg-img" src="/images/common/uc-bg2.jpg">
        <img class="avatar-img" :src="user.avatar">
        <p>usercenter</p>
    </header>
    <section id="uc-nav-container">
        <div class="nav-wrapper">
        <p>usercenterwrap</p>
            <router-link :to="{name:'order-list',params:{'type':'all'}}">
            <p>全部订单</p>
                <mt-cell title="全部订单">
                    <img slot="icon" src="/images/icon/order-finish.png" width="24" height="24">
                </mt-cell>
            </router-link>


            <mt-cell title="待付款" is-link v-link="{name:'order-list',params:{'type':'unpay'}}">
                <img slot="icon" src="/images/icon/order-unpay.png" width="24" height="24">
            </mt-cell>
            <mt-cell title="已付款" is-link v-link="{name:'order-list',params:{'type':'unreceived'}}">
                <img slot="icon" src="/images/icon/order-delivered.png" width="24" height="24">
            </mt-cell>
        </div>
        <!-- event项目不需要邮寄地址 -->
        <!-- <div class="nav-wrapper">
            <mt-cell title="地址管理" is-link v-link="{name:'address'}">
                <img slot="icon" src="/images/icon/uc-address.png" width="24" height="24">
            </mt-cell>
        </div> -->
        <div class="nav-wrapper">
            <mt-cell title="意见建议" is-link v-link="{name:'suggestion'}">
                <img slot="icon" src="/images/icon/uc-suggestion.png" width="24" height="24">
            </mt-cell>
        </div>
    </section>
</template>

<script>
    import { Cell } from 'mint-ui'
    export default{
        data(){
            return {
                user:''
            }
        },
        components:{
            Cell
        },
        created(){
            this.initHeader();
        },
        methods:{
            initHeader:function(){
                let vm = this;
                //vm.$set('user',vm.$parent.user);
                vm.user = vm.$parent.user;
            }
        }
    }
</script>

