<template>
  <div>
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="100">
      <card v-for="item in data" :item="item"></card>
    </div>
    <router-link :to="{path: '/newbottle'}"><palette-button class="new"></palette-button></router-link>
    <tab-bar></tab-bar>
  </div>
</template>

<script>
import PaletteButton from '@/components/PaletteButton'
import TabBar from '@/components/TabBar'
import Card from './Card'

export default {
  components: {
    PaletteButton,
    TabBar,
    Card
  },
  data () {
    return {
      loading: false,
      data: [],
      lastId: 999999
    }
  },
  methods: {
    getBottles: function (id=null) {
      let url;
      if(id === null)
        url = '/bottle-new/api/?_action=getMoreBottles'
      else
        url = '/bottle-new/api/?_action=getMoreBottles&id=' + id;
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
    this.getBottles();
  }
}
</script>

<style>
.new {
  position: fixed;
  z-index: 999;
  bottom: 220px;
  right:80px;
}
</style>
