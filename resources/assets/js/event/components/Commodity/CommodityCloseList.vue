<template>
    <div id="list-data-container">
        <div v-for="item in list" class="list-data-wrapper" v-link="{name:'commodity',params:{hashid:item.id}}">
            <img :src="item.event_img" alt="item.event_name"/>
            <div class="data-info-wrapper">
                <p class="title">
                    {{item.event_name}}(主办方:{{item.manager_id}})
                </p>
                <p class="price">
                    截止日期:{{item.end_time}}({{item.status}})
                </p>
            </div>
        </div>
    </div>

</template>

<script>
    export default{
        props:{
            list:{
                type: Array,
                twoWay: true,
                default:function(){
                    return {
                        data:[]
                    };
                }
            }
        }
    }
</script>
