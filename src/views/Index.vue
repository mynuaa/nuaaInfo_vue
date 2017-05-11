<template>
  <div class="index-container">
    <router-view></router-view>
    <div
      class="infinite-scroll"
      :class="{ 'hidden': $route.name !== 'index' }"
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id" class="pointer"></card>
    </div>
    <palette-button :class="{ 'hide': hideNonImportants || $route.name !== 'index' }"></palette-button>
  </div>
</template>

<script>
import PaletteButton from '@/components/PaletteButton'
import Card from './Card'

export default {
  components: {
    PaletteButton,
    Card
  },
  data () {
    return {
      loading: false,
      data: [],
      lastId: 9999999,
      oldScreenY: 0,
      hideNonImportants: false
    }
  },
  methods: {
    getBottles: function (id=null) {
      let url;
      url = id ? `/bottle/api/?_action=getMoreBottles&id=${id}` : '/bottle/api/?_action=getMoreBottles';
      this.axios.get(url).then(response => {
        if (response.data.data) {
          this.data = this.data.concat(response.data.data);
          this.lastId = this.data[this.data.length-1].id;
          this.loading = false;
        }
      })
    },
    loadMore: function () {
      this.loading = true;
      this.getBottles(this.lastId);
    },
    refresh: function () {
      this.lastId = 9999999,
      this.data = [];
      this.loadMore();
    }
  },
  mounted() {
    window.eventBus.$on('hideNonImportants', hide => {
      this.hideNonImportants = hide;
    });
    window.eventBus.$on('indexRefresh', () => {
      this.refresh();
    });
  },
  beforeRouteUpdate(to, from, next) {
    window.eventBus.$emit('hideNonImportants', false);
    if (this.$route.name !== 'index') {
      window.eventBus.$emit('titleChange', '首页');
      document.body.className = '';
    } else {
      document.body.className = 'no-scroll';
    }
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
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}
.hidden {
    visibility: hidden;
}
</style>
