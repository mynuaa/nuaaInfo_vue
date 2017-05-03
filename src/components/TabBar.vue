<template>
  <div class="tabbar">
      <span>更多</span>
      <span class="split" ><router-link :to="{path: '/details'}">消息</router-link></span>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.tabbar {
  position: fixed;
  bottom: 0;
  width: 100%;
  min-height: 100px;
  border-top: 1px solid;
  background-color: white;
}
.tabbar>span {
  display: inline-block;
  text-align: center;
  width: 49%;
  font-size: 2em;
  line-height: 100px;
}
.split {
  border-left: 1px solid;
}
</style>
