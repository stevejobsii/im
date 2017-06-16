<template>
    <div id="list-data-container">
        <router-link tag='div' v-for="item in list" :key="item.id" class="list-data-wrapper" :to="{name:'commodity',params:{hashid:item.id}}">
            <img :src="item.event_img" alt="item.event_name"/>
            <div class="data-info-wrapper">
                <p class="title">
                    {{item.event_name}}
                </p>
                <p class="price">
                    截止日期:{{item.end_time}}({{item.status}})
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
