<template>
  <div class="topics">
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
      lastId: 999999,
      show: true,
      topic: null,
      hideNonImportants: false
    }
  },
  methods: {
    getBottles: function (id=null) {
      let url;
      if(id === null)
        url = '/bottle/api/?_action=getTopic&topic=' + this.$route.params.topic;
      else
        url = '/bottle/api/?_action=getTopic&topic=' + this.$route.params.topic + '&id=' + id;
      this.axios.get(url).then((response) => {
        if(response.data.data === undefined)
          return

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
  beforeUpdate() {
    if (this.$route.params.topic !== this.topic) {
      window.eventBus.$emit('titleChange', '#' + this.$route.params.topic + '#');
      this.data = [];
      this.loading = false;
      this.lastId = 999999;
      this.topic = this.$route.params.topic;
      this.loadMore();
    }
  },
  mounted() {
    window.eventBus.$on('hideNonImportants', hide => {
      this.hideNonImportants = hide;
    });
  }
}
</script>

<style>
</style>
