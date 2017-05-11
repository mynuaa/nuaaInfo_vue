<template>
    <div class="bottle-footer" :class="{
        'v2': !logged,
        'v3': logged
    }" v-if="showFooter">
        <a class="clickable" @click="indexClick">首页</a>
        <a :href="loginUrl" class="clickable" v-if="!logged">快速登录</a>
        <router-link to="/mybottles" class="clickable" v-if="logged">我的瓶子</router-link>
        <a :href="logoutUrl" class="clickable" v-if="!!logged">退出登录</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logged: !!window.bottle.user
        }
    },
    computed: {
        showFooter: function () {
            return this.$route.name === 'index' ||
                   this.$route.name === 'topics' ||
                   this.$route.name === 'mybottles';
        },
        loginUrl: function () {
            return '/sso/?page=login&redirect_uri=' + btoa(location.pathname);
        },
        logoutUrl: function () {
            return '/sso/?action=logout&redirect_uri=' + btoa(location.pathname);
        }
    },
    methods: {
        indexClick: function () {
            if (this.$route.name === 'index') {
                window.eventBus.$emit('indexRefresh');
            } else {
                this.$router.push('/');
            }
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
.bottle-footer.v2 a {
    width: 50%;
}
.bottle-footer.v3 a {
    width: 33.333333%;
}
.bottle-footer a {
    float: left;
    height: 50px;
    line-height: 50px;
    box-sizing: border-box;
    text-align: center;
    border-right: 1px solid #F1F1F1;
}
.bottle-footer a:last-child {
    border-right: none;
}
</style>
