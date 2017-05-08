<template>
  <div>
    <div
      v-infinite-scroll="loadMore"
      infinite-scroll-disabled="loading"
      infinite-scroll-distance="10">
      <card v-for="item in data" :item="item" :key="item.id"></card>
    </div>
    <palette-button :class="{ 'hide': !show }"></palette-button>
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
        oldScreenX: 0,
        show: true
      }
    },
    methods: {
      getBottles: function (id=null) {
        let url;
        if(id === null)
          url = '/bottle-new/api/?_action=getMyBottles';
        else
          url = '/bottle-new/api/?_action=getMyBottles' + '&id=' + id;
        this.axios.get(url).then((response) => {
          if(response.data.code === 2) {
            let back_url = '/#' + this.$route.path;
            let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
            window.location.href = login_url;
          }
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
    mounted () {
      window.eventBus.$emit('titleChange', '我的瓶子');
    }
  }
</script>
