<template>
  <div class="mybottles index-children">
    <h2>{{user}} 扔过的瓶子们</h2>
    <div class="card" v-if="!loading && data.length === 0">
      <p>你还没有扔过瓶子呢...</p>
      <mt-button type="primary" @click="$router.push('/newbottle')">扔一个</mt-button>
    </div>
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id" class="clickable"></card>
    </div>
  </div>
</template>

<script>
  import Card from './Card'

  export default {
    components: {
      Card
    },
    data () {
      return {
        loading: false,
        data: [],
        lastId: 999999,
        oldScreenX: 0,
        show: true,
        user: window.bottle.user.username
      }
    },
    methods: {
      getBottles: function (id = null) {
        const url = '/bottle/api/?_action=getMyBottles' + (id ? `&id=${id}` : '');
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
      }
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
