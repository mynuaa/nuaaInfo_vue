<template>
  <div class="index-container" @click="topicShow=false">
    <div class="da-header" :class="{'headerHide': !show, '':show}">
      <span class="to-topics" @click.stop="topicShow=true" @blur="topicShow=false">#话题#</span>
      <ul class="topics" v-if="topicShow">
        <li><router-link to="/topics/你有我没有">你有我没有</router-link></li>
        <li><router-link to="/topics/我对南航说">我对南航说</router-link></li>
        <li><router-link to="/topics/对学弟学妹的忠告">对学弟学妹的忠告</router-link></li>
        <li><router-link to="/topics/我最想对你说">我最想对你说</router-link></li>
      </ul>
    </div>
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
      show: true,
      topicShow: false
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
    console.log('parent mounted')
  },
  created(){
    document.title = '南航-Bottle'
  }
}
</script>

<style>
.index-container {
  margin-top: 80px;
}
.to-topics {
  color: white;
  float: right;
  margin-right: 40px;
  height: 100%;
  line-height: 51px;
  font-size: 20px;
  box-shadow: 0 0 15px white;
  padding: 0px 20px
}
.topics {
  position: fixed;
  top: 80px;
  right: 0;
  list-style: none;
  padding: 0;
  text-align: center;
  background-color: white;
}
.topics a {
  display: inline-block;
  padding: 15px 20px;
}
.new {
  position: fixed;
  z-index: 999;
  bottom: 51px;
  right:0px;
  transition: all 0.5s;
}
.newHide {
  bottom: -300px;
}
.headerHide {
  top: -100px!important;
}
</style>
