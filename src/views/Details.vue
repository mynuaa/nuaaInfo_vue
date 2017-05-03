<template>
  <div class="details">
    <div class="da-header">
      <button @click="$router.back(-1)"><i class="fa fa-chevron-left fa-5x"></i></button>
    </div>
    <card :item="data"></card>
    <div class="comments">
      <comment v-for="comment in comments" :comment="comment"></comment>
    </div>
    <div class="newComments">
      <input type="text" placeholder="发布评论">
      <button>
        <i class="fa fa-paper-plane-o fa-4x"></i>
      </button>
    </div>
  </div>
</template>

<script>
  import Card from '@/views/Card'
  import Comment from '@/views/Comment'

  export default {
    components: {
      Card,
      Comment
    },
    data () {
      return {
        data: {},
        comments: []
      }
    },
    methods: {
      getBottle: function () {
        this.axios.get('/bottle-new/api/?_action=getBottle&id='+this.$route.params.id).then((response) => {
          this.data = response.data.data;
//          let date = new Date();
//          let now = parseInt(date.getTime()/1000);
//          let result = now - this.data.date;
//          if(result < 60){
//            this.data.date = result+"秒前";
//          }else if((result/60) <= 60){
//            this.data.date = parseInt(result/60) + "分钟前";
//          }else if((result/3600) <= 60){
//            this.data.date = parseInt(result/3600) +"小时前";
//          }else{
//            this.data.date = parseInt(result/86400) + "天前"
//          }
          var date = this.$moment(this.data.date, 'X').fromNow();
          console.log(date);
        })
      },
      getComments: function () {
        this.axios.get('/bottle-new/api/?_action=getComments&id='+this.$route.params.id).then((response) => {
          this.comments = response.data.data;
          console.log(this.comments);
        })
      }
    },
    mounted () {
      this.getBottle();
      this.getComments();
    }
  }
</script>

<style>
.da-header {
  height: 100px;
  width: 100%;
  background: rgb(66, 185, 131);
}
.da-header button{
  outline: none;
  border: none;
  height: 100px;
  width: 100px;
  background-color: rgba(0, 0, 0, 0);
  color: white;
}
.comments {
  width: 100%;
}
input {
  outline: none;
}
.newComments {
  position: fixed;
  width: 100%;
  height: 120px;
  bottom: 0;
  border-top: 1px solid black;
  padding: 20px 0 8px 20px;
  background-color: white;
}
.newComments input{
  height: 80px;
  width: 80%;
  padding: 10px 30px;
  font-size: 2.5rem;
  display: inline-block;
  border: none;
  border-radius: 20px;
  background-color: lightgray;
}
.newComments button{
  height: 120px;
  width: 120px;
  position: absolute;
  right: 20px;
  display: inline-block;
  background-color: rgba(0, 0, 0, 0);
  border: none;
  outline: none;
}
</style>
