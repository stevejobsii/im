<template>
  <div>
    <header id="uc-head-container">
        <img class="bg-img" src="/images/common/uc-bg2.jpg">
        <img class="avatar-img" :src="user.avatar">
    </header>
    <section id="uc-nav-container">
        <div class="nav-wrapper">
            <mt-cell  is-link :to="{name:'order-list',params:{'type':'all'}}">
                <img slot="icon" src="/images/icon/order-finish.png" width="24" height="24">
                <p slot="title">{{ trans('imall.all_order') }}</p>
            </mt-cell>
            <mt-cell is-link :to="{name:'order-list',params:{'type':'unpay'}}">
                <img slot="icon" src="/images/icon/order-unpay.png" width="24" height="24">
                <p slot="title">{{ trans('imall.unpay_order') }}</p>
            </mt-cell>

            <mt-cell is-link :to="{name:'order-list',params:{'type':'unreceived'}}">       
                <img slot="icon" src="/images/icon/order-delivered.png" width="24" height="24">
                <p slot="title">{{ trans('imall.paid_order') }}</p>
            </mt-cell>

        </div>
        <!-- event项目不需要邮寄地址 -->
        <!-- <div class="nav-wrapper">
            <mt-cell title="地址管理" is-link to="{name:'address'}">
                <img slot="icon" src="/images/icon/uc-address.png" width="24" height="24">
            </mt-cell>
        </div> -->
        <div class="nav-wrapper">
            <mt-cell :title='{{ trans('imall.suggestion') }}' is-link :to="{name:'suggestion'}">
                <img slot="icon" src="/images/icon/uc-suggestion.png" width="24" height="24">
            </mt-cell>
        </div>
    </section>
  </div>
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

