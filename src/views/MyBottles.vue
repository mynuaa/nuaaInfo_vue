<template>
  <div class="mybottles index-children">
    <h2>{{user}} 扔过的瓶子们</h2>
    <div class="card" v-if="noBottle">
      <p>你还没有扔过瓶子呢...</p>
      <mt-button type="primary" @click="$router.push('/newbottle')">扔一个</mt-button>
    </div>
    <div
      v-infinite-scroll="getBottles"
      :infinite-scroll-disabled="loadingStatus === 'loading'"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id" class="pointer"></card>
    </div>
    <loading-placeholder
      :status="loadingStatus"
      :retry="getBottles">
    </loading-placeholder>
  </div>
</template>

<script>
import getBottles from 'utils/getBottles';
export default {
  data () {
    return {
      loadingStatus: '',
      data: [],
      lastId: 999999,
      oldScreenX: 0,
      show: true,
      user: window.bottle.user.username
    }
  },
  computed: {
    noBottle: function () {
      return this.loadingStatus === '' && this.data.length === 0;
    }
  },
  methods: {
    getBottles: function () {
      getBottles.bind(this)('getMyBottles');
    },
  },
  mounted() {
    window.eventBus.$emit('titleChange', '我的瓶子');
  }
}
</script>

<style>
.mybottles h2 {
  max-width: 960px;
  margin: 10px auto 15px;
  padding: 0 10px;
}
.mybottles .card button {
    margin-bottom: 20px;
    width: 100%;
}
</style>
