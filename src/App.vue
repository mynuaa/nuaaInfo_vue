<template>
    <div id="app" v-if="gotUser" @touchstart="handleTouchstart" @touchmove="handleTouchmove">
        <bottle-header :class="{ 'hide': hide }"></bottle-header>
        <router-view></router-view>
        <bottle-footer :class="{ 'hide': hide }"></bottle-footer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            hide: false,
            gotUser: false
        };
    },
    methods: {
        handleTouchstart: function (event) {
            this.oldScreenY = event.touches[0].screenY;
        },
        handleTouchmove: function (event) {
            const move = event.touches[0].screenY - this.oldScreenY;
            if (move > 30 || window.scrollY < 50) {
                window.eventBus.$emit('hideNonImportants', false);
                this.oldScreenY = event.touches[0].screenY;
            } else if (move < -30) {
                window.eventBus.$emit('hideNonImportants', true);
                this.oldScreenY = event.touches[0].screenY;
            }
        }
    },
    mounted() {
        this.axios.defaults.withCredentials = true;
        window.bottle = {
            user: null,
            userLogged: function () {
                if (window.bottle.user) {
                    return true;
                } else {
                    location.href = window.bottle.ssoUrl;
                    return false;
                }
            }
        };
        window.eventBus.$on('hideNonImportants', hide => {
            this.hide = hide;
        });
        this.axios.get('/bottle/api/?_action=getUser').then(response => {
            window.bottle.user = response.data.data || null;
            window.bottle.ssoUrl = '/sso/?page=login&redirect_uri=' + btoa(location.pathname);
            this.gotUser = true;
        });
    }
}
</script>

<style>
* {
    -webkit-tap-highlight-color: transparent;
}
body {
    font-family: 'PingFang SC', 'Helvetica Neue', 'Hiragino Sans GB', 'Segoe UI', 'Microsoft YaHei UI', '微软雅黑', sans-serif;
    width: 100%;
    height: 100%;
    margin: 0;
    font-size: 14px;
    background: #F1F1F1;
    overflow-x: hidden;
}
a {
    text-decoration: none;
    color: black;
}
input, button, textarea {
    outline: none;
}
#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2C3E50;
    padding-top: 60px;
    padding-bottom: 50px;
}
.clickable {
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.clickable:active {
    background: rgba(0, 0, 0, 0.1);
}
button {
    font-size: 14px !important;
}
</style>
