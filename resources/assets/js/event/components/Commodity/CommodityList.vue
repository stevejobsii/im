<template>
    <div id="list-data-container">
        <router-link tag='div' v-for="item in list" class="list-data-wrapper" :to="{name:'commodity',params:{hashid:item.id}}">
            <img :src="item.event_img" alt="item.event_name"/>
            <div class="data-info-wrapper">
                <p class="title">
                    {{item.event_name}}
                </p>
                <p>
                    (主办方:{{item.manager}}、地点:{{item.event_place}})
                </p>
                <p class="price">
                    日期:{{item.end_time}}({{item.status}})
                </p>
                <p class="price">
                    &yen;{{item.event_current_price}}&emsp;<del>&yen;{{item.event_original_price}}</del>
                    <span>剩余：{{item.event_stock_number}}件</span>
                </p>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default{
        props:{
            list:{
                type: Array,
                default:function(){
                    return {
                        data:[]
                    };
                }
            }
        }
    }
</script>
