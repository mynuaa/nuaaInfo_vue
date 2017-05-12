<template>
    <div class="loading-text">
        <div v-if="status === 'error'" @click="retry()">
            <i class="fa fa-refresh"></i>
            <span>出错啦，点我重试</span>
        </div>
        <div v-else-if="status === 'finish'">
            <span>— 我也是有底线的 (･`ω･´) —</span>
        </div>
        <div v-else>
            <i class="fa fa-pulse fa-spinner"></i>
            <span>加载中...</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['status', 'retry']
}
</script>

<style>
.loading-text {
    text-align: center;
    padding: 10px 0 20px;
}
.loading-text .fa-refresh + span {
    cursor: pointer;
}
</style>
