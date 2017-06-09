<template>
    <router-view></router-view>
    <p>123</p>
    <navbar></navbar>
</template>

<script>
    import Navbar from './components/_layouts/Navbar.vue';

    // 为了给View中暴露需要使用的函数.
    export default{
        components:{
            Navbar
        },
        //replace: false,
        //data:function(){}，下面是es6写法
        data(){
            return{
                user:''
            }
        },
        // created 这个钩子在实例被创建之后被调用
        created(){
            this.fetchUser();
        },
        methods:{
            fetchUser:function(){
                let vm = this;
                let userInfo = localStorage.getItem('userInfo');
                let shopConfig = localStorage.getItem('shopConfig');
                if(userInfo){
                    vm.$set('user',JSON.parse(userInfo));
                }else{
                    vm.$http.get('/api/userinfo').then(function(response){
                        vm.$set('user',response.data);
                        localStorage.setItem('userInfo', JSON.stringify(response.data));
                    });
                }
                // if(!shopConfig){
                //     vm.$http.get('/api/shopconfig').then(function(response){
                //         localStorage.setItem('shopConfig', JSON.stringify(response.data));
                //     });
                // }
            }
        }
    }
</script>
