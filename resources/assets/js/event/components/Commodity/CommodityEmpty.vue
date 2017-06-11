<template>
  <div>
    <section id="empty-data-container" v-show="isShow">
        <div class="empty-data-wrapper">
            <img src="/images/common/empty.png"/>
            <h4>没有找到相关活动T.T</h4>
            <p>老板太懒了，先去其他位置逛逛吧</p>
            <!-- <a :to="{name:'category'}">去逛逛</a> -->
        </div>
    </section>
  </div>
</template>

<script>
export default{
    props:{
        isShow:{
            type: Boolean,
            //twoWay: true,
            default: false
        }
    }
}
</script>
