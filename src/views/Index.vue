<template>
  <div class="index-container">
    <router-view></router-view>
    <div
      class="infinite-scroll"
      v-infinite-scroll="getBottles"
      :infinite-scroll-disabled="loadingStatus === 'loading'"
      infinite-scroll-distance="100">
      <card v-for="item in data" :item="item" :key="item.id" class="pointer"></card>
    </div>
    <loading-placeholder
      :status="loadingStatus"
      :retry="getBottles">
    </loading-placeholder>
    <palette-button :class="{ 'hide': hideNonImportants || $route.name !== 'index' }"></palette-button>
  </div>
</template>

<script>
import getBottles from 'utils/getBottles';
export default {
  data () {
    return {
      loadingStatus: '',
      data: [],
      lastId: 9999999,
      oldScreenY: 0,
      hideNonImportants: false
    }
  },
  methods: {
    getBottles: function () {
      getBottles.bind(this)('getMoreBottles');
    },
    refresh: function () {
      this.lastId = 9999999,
      this.data = [];
      this.getBottles();
    },
    init: function (to = this.$route.name) {
      window.eventBus.$emit('hideNonImportants', false);
      if (to === 'index') {
        window.eventBus.$emit('titleChange', '首页');
        document.body.className = '';
      } else {
        document.body.className = 'no-scroll';
      }
    }
  },
  mounted() {
    this.init();
    window.eventBus.$on('hideNonImportants', hide => {
      this.hideNonImportants = hide;
    });
    window.eventBus.$on('indexRefresh', () => {
      this.refresh();
    });
  },
  beforeRouteUpdate(to, from, next) {
    this.init(to.name);
    next();
  }
}
</script>

<style>
body.no-scroll {
    overflow: hidden;
}
.index-children {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 60px 0 50px;
    background: #F1F1F1;
    overflow-y: auto;
    z-index: 2;
}
</style>
