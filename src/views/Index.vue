<template>
  <div class="index-container" @click="topicShow=false">
    <ul class="topics" v-if="topicShow">
      <li><router-link to="/topics/你有我没有">你有我没有</router-link></li>
      <li><router-link to="/topics/我对南航说">我对南航说</router-link></li>
      <li><router-link to="/topics/对学弟学妹的忠告">对学弟学妹的忠告</router-link></li>
      <li><router-link to="/topics/我最想对你说">我最想对你说</router-link></li>
    </ul>
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id"></card>
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
      hideNonImportants: false,
      topicShow: false
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
</style>
