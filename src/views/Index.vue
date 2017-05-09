<template>
  <div class="index-container">
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id" class="clickable"></card>
    </div>
    <palette-button :class="{ 'hide': hideNonImportants }"></palette-button>
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
      this.axios.get(url).then((response) => {
        this.data = this.data.concat(response.data.data);
        this.lastId = this.data[this.data.length-1].id;
        this.loading = false;
      })
    },
    loadMore: function () {
      this.loading = true;
      this.getBottles(this.lastId);
    }
  },
  mounted() {
    window.eventBus.$emit('titleChange', '首页');
    window.eventBus.$on('hideNonImportants', hide => {
      this.hideNonImportants = hide;
    });
  },
}
</script>

<style>
</style>
