<template>
  <div class="tabbar" :class="{'hide': !show, '': show}">
      <span><router-link :to="{path: '/'}">首页</router-link></span>
      <span class="split" ><router-link :to="{path: '/mybottles'}">我的瓶子</router-link></span>
  </div>
</template>

<script>
export default {
  props: {
    show: Boolean
  }
}
</script>

<style>
.tabbar {
  position: fixed;
  bottom: 0;
  width: 100%;
  min-height: 100px;
  box-shadow: 0 -1px 15px grey;
  background-color: white;
  transition: all 0.5s;
}
.tabbar>span {
  display: inline-block;
  text-align: center;
  width: 49%;
  line-height: 100px;
}
.split {
  border-left: 1px solid;
}
.hide {
  bottom: -100px;
}
</style>
