<template>
  <div class="topics index-children">
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
      show: true,
      topic: null,
    }
  },
  methods: {
    getBottles: function () {
      getBottles.bind(this)('getTopic', this.$route.params.topic);
    }
  },
  beforeUpdate() {
    if (this.$route.params.topic !== this.topic) {
      window.eventBus.$emit('titleChange', '#' + this.$route.params.topic + '#');
      this.data = [];
      this.loading = false;
      this.lastId = 999999;
      this.topic = this.$route.params.topic;
      this.getBottles();
    }
  }
}
</script>

<style>
</style>
