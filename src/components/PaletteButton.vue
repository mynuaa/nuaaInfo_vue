<template>
  <router-link :to="{path: '/newbottle'}" class="palette-button">
      <i class="fa fa-plus"></i>
  </router-link>
</template>

<script>
export default {
}
</script>

<style>
.palette-button {
    position: fixed;
    right: 20px;
    bottom: 70px;
    border-radius: 100%;
    width: 50px;
    height: 50px;
    background-color: #42B983;
    color: white;
    box-shadow: 0 1px 3px  rgba(0, 0, 0, 0.2);
    text-align: center;
    transition: all 0.5s;
    z-index: 10;
}
.palette-button.hide {
    right: -60px;
}
.palette-button > i {
    line-height: 50px;
}
</style>
