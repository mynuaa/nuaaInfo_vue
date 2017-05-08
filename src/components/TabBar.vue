<template>
  <div class="tabbar" :class="{'hide': !show, '': show}">
      <router-link :to="{path: '/'}">首页</router-link>
      <router-link :to="{path: '/mybottles'}" class="split">我的瓶子</router-link>
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
  max-height: 51px;
  box-shadow: 0 -1px 15px grey;
  background-color: white;
  transition: all 0.5s;
}
.tabbar>span {
  display: inline-block;
  text-align: center;
  width: 49%;
  line-height: 51px;
}
.split {
  border-left: 1px solid;
}
.hide {
  bottom: -100px;
}
</style>
