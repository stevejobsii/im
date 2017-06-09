import Vue from 'vue'
import Mint from 'mint-ui'
import {InfiniteScroll,Indicator} from 'mint-ui';
import axios from 'axios'
import VueRouter from 'vue-router'
import lodash from 'lodash'
//import App from './App.vue'
var App = require('./App.vue');
// 安装 Vue.js de Mint插件
Vue.use(Mint);
Vue.use(InfiniteScroll);
// 使用Vue－Router
Vue.use(VueRouter);
Vue.config.debug = true;//开启错误提示

// vuejs using laravel blade inside(双语翻译用)
// 添加实例 trans  为  查找 lang.js 的函数
Vue.prototype.trans = string => _.get(window.i18n, string);

/**
 * 价格转换为0.00的浮点数，Vue.filter为全局过滤器
 */
Vue.filter('transformPrice', function (value) {
    if (value >= 0) {
        return parseFloat(value).toFixed(2);
    }
});

/**
 * 商品详情换行，Vue.filter为全局过滤器
 */
Vue.filter('rnTransform', function (value) {
    if (value) {
        return value.replace(/\r\n/g, "<br/>");
    }
});

/**
 * 数据列表无限滚动监听，Vue.directive注册全局指令。
 */
Vue.directive('data-scroll', function (value) {
    window.addEventListener('scroll', ()=> {
        let fnc = value;
        fnc();
    });
});

/**
 * 手机号隐私处理，Vue.filter为全局过滤器
 */
Vue.filter('transformPhone', function (value) {
    if (value) {
        let phone = value;
        let phone_head = phone.substring(0, 3);
        let phone_foot = phone.substr(7, 4);
        return phone_head + '****' + phone_foot;
    }
});

// 配置是否允许 vue-devtools 检查代码。开发版本默认为 true，生产版本默认为 false。
Vue.config.devtools = true;

// $http  为  axios 的  缩写
Vue.prototype.$http = axios;

// vue更新到2.0之后,作者就宣告不再对vue-resource更新,而是推荐的axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const routes = [
        {
            path: '*',
            redirect: '/usercenter'
        },
        {   
            path: '/:hashid/commodity',
            // 命名路由
            name: 'commodity',
            component: require('./components/Commodity/CommodityDetail.vue')
        },
        {
            path: '/cart',
            name: 'cart',
            component: require('./components/Cart.vue')
        },
        {   path: '/usercenter',
            name: 'usercenter',
            component: require('./components/UserCenter.vue')
        },
        {
            path:'/ordersettle',
            name: 'order-settle',
            component: require('./components/Order/OrderSettle.vue')
        },
        {
            path: '/:type/orderlist',
            name: 'order-list',
            component: require('./components/Order/OrderList.vue')
        },
        {
            path:'/:hashid/orderdetail',
            name: 'order-detail',
            component: require('./components/Order/OrderDetail.vue')
        },
        {
            path: '/:hashid/orderpay',
            name: 'orderpay',
            component: require('./components/Order/OrderPay.vue')
        },
        {
            path: '/suggestion',
            name: 'suggestion',
            component: require('./components/Suggestion/Suggestion.vue')
        }
        // {
        //     path:'/eventlist',
        //     name: 'eventlist',
        //     component: require('./components/Attribute/Attribute.vue'),
        //     children: [                
        //         {
        //             path:'/close',
        //             name: 'aClose',
        //             component: require('./components/Attribute/Close.vue')
        //         },
        //         {
        //             path:'/open',
        //             name: 'aOpen',
        //             component: require('./components/Attribute/Open.vue')
        //         }
        //     ]
        // }
    ];

const router = new VueRouter({
    //mode: 'abstract',
    routes
});


// 导航钩子 http://router.vuejs.org/zh-cn/advanced/navigation-guards.html 
router.beforeEach((transition) => {
    document.body.scrollTop = 0;
    Indicator.close();
    transition.next();
});

// const vm = new Vue({
//   router,
//   // 渲染（render）函数
//   //render: h => h(App), // render function
// }).$mount('body');

new Vue({
  el: 'body',
  router,
  render: h => h(App)
});
