<template>
    <header class="bottle-header">
        <div class="back clickable" @click="historyBack" :class="{ 'hide': isAtRoot }">
            <i class="fa fa-chevron-left"></i>
        </div>
        <h1 @dblclick="goToTop">{{title}}</h1>
    </header>
</template>

<script>
export default {
    data() {
        return {
            title: '南航Bottle'
        }
    },
    computed: {
        isAtRoot: function () {
            return this.$route.name === 'index';
        }
    },
    methods: {
        historyBack: function () {
            this.$router.go(-1);
        },
        goToTop: function () {
            if (window.requestAnimationFrame) {
                const anime = () => {
                    if (document.body.scrollTop > 1) {
                        document.body.scrollTop /= 1.2;
                        requestAnimationFrame(anime);
                    } else {
                        document.body.scrollTop = 0;
                    }
                };
                requestAnimationFrame(anime);
            } else {
                document.body.scrollTop = 0;
            }
        }
    },
    mounted: function () {
        window.eventBus.$on('titleChange', title => {
            document.title = `${title} - 南航Bottle`;
            this.title = title;
        });
    }
}
</script>

<style>
.bottle-header {
    position: fixed;
    width: 100%;
    top: 0;
    height: 50px;
    line-height: 50px;
    background: rgba(66, 185, 131, 0.95);
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    transition: all 0.5s;
    z-index: 3;
}
.bottle-header.hide {
    top: -60px;
}
.bottle-header .back {
    position: absolute;
    top: 0;
    left: 0;
    color: #FFF;
    padding: 0 20px;
    height: 50px;
    line-height: 50px;
}
.bottle-header .back.hide {
    display: none;
}
.bottle-header h1 {
    -webkit-user-select: none;
    user-select: none;
    color: #FFF;
    font-size: 16px;
    font-weight: normal;
    height: 50px;
    line-height: 50px;
    margin: 0;
    text-align: center;
}
</style>
