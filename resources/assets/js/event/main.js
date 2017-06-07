import Vue from 'vue'
import Mint from 'mint-ui'
import {InfiniteScroll,Indicator} from 'mint-ui';
import axios from 'axios'
import VueRouter from 'vue-router'
import App from './App.vue'
import lodash from 'lodash'

Vue.use(Mint);
Vue.use(InfiniteScroll);
// 使用Vue－Router
Vue.use(VueRouter);

// vuejs using laravel blade inside(双语翻译用)
Vue.prototype.trans = string => _.get(window.i18n, string);

/**
 * 价格转换为0.00的浮点数
 */
Vue.filter('transformPrice', function (value) {
    if (value >= 0) {
        return parseFloat(value).toFixed(2);
    }
});

/**
 * 商品详情换行
 */
Vue.filter('rnTransform', function (value) {
    if (value) {
        return value.replace(/\r\n/g, "<br/>");
    }
});

/**
 * 数据列表无限滚动监听
 */
Vue.directive('data-scroll', function (value) {
    window.addEventListener('scroll', ()=> {
        let fnc = value;
        fnc();
    });
});

/**
 * 手机号隐私处理
 */
Vue.filter('transformPhone', function (value) {
    if (value) {
        let phone = value;
        let phone_head = phone.substring(0, 3);
        let phone_foot = phone.substr(7, 4);
        return phone_head + '****' + phone_foot;
    }
});

Vue.config.devtools = true;
Vue.prototype.$http = axios;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const router = new VueRouter({
    routes:[
        {
            path: '*',
            redirect: '/usercenter'
        },
        {   
            path: '/:hashid/commodity',
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
        },
        {
            path:'/eventlist',
            name: 'eventlist',
            component: require('./components/Attribute/Attribute.vue'),
            children: [                
                {
                    path:'/close',
                    name: 'aClose',
                    component: require('./components/Attribute/Close.vue')
                },
                {
                    path:'/open',
                    name: 'aOpen',
                    component: require('./components/Attribute/Open.vue')
                }
            ]
        }
    ]
});

// routerMap 为 router.js
// routerMap(router);

router.beforeEach((transition) => {
    document.body.scrollTop = 0;
    Indicator.close();
    transition.next();
});

new Vue({ router }).$mount('body')
