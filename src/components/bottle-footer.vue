<template>
    <div class="bottle-footer" v-if="showFooter">
        <router-link to="/" class="clickable">首页</router-link>
        <router-link to="/mybottles" class="clickable">我的瓶子</router-link>
    </div>
</template>

<script>
export default {
    computed: {
        showFooter: function () {
            return this.$route.name === 'index' ||
                   this.$route.name === 'topics' ||
                   this.$route.name === 'mybottles';
        }
    }
}
</script>

<style>
.bottle-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 50px;
    box-sizing: border-box;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    background-color: rgba(255, 255, 255, 0.95);
    transition: all 0.5s;
}
.bottle-footer.hide {
    bottom: -60px;
}
.bottle-footer a {
    float: left;
    width: 50%;
    height: 50px;
    line-height: 50px;
    box-sizing: border-box;
    text-align: center;
}
.bottle-footer a:first-child {
    border-right: 1px solid #F1F1F1;
}
</style>
