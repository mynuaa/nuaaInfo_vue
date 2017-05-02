<template>
  <div class="tabbar">
      <span @click="">更多</span>
      <span class="split" @click="">消息</span>
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
  min-height: 140px;
  border-top: 1px solid;
}
.tabbar>span {
  display: inline-block;
  text-align: center;
  width: 49%;
  font-size: 3em;
  line-height: 140px;
}
.split {
  border-left: 1px solid;
}
</style>
