<template>
  <div>
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10"
      @touchstart="handleTouchstart"
      @touchmove="handleTouchmove">
      <card v-for="item in data" :item="item"></card>
    </div>
    <router-link :to="{path: '/newbottle'}"><palette-button class="new" :class="{'newHide': !show, '':show}"></palette-button></router-link>
    <tab-bar :show="show"></tab-bar>
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
      lastId: 999999,
      oldScreenX: 0,
      show: true
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
        console.log(this.data)
      })
    },
    loadMore: function () {
      this.loading = true;
      this.getBottles(this.lastId);
    },
    handleTouchstart: function (event) {
      this.oldScreenX = event.touches[0].screenX
    },
    handleTouchmove: function (event) {
      console.log(event)
      let move = event.touches[0].screenX - this.oldScreenX;
      if( move > 3) {
        this.show = false;
        this.oldScreenX = event.touches[0].screenX;
      }else if(move < -3) {
        this.show = true;
      }
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
  transition: all 0.5s;
}
.newHide {
  bottom: -300px
}
</style>
