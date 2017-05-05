<template>
  <div class="details">
    <div class="da-header">
      <button @click="$router.back(-1)"><i class="fa fa-chevron-left fa-4x"></i></button>
    </div>
    <card v-if="data.content":item="data" class="details-card"></card>
    <div class="comments">
      <comment v-for="comment in comments" :comment="comment"></comment>
    </div>
    <div class="newComments">
      <input type="text" placeholder="发布评论" v-model="newComment.content">
      <button @click="sendComment">
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
        comments: [],
        newComment: {
          postId: 0,
          content: '',
          secret: true,
          gender: 1,
        }
      }
    },
    methods: {
      getBottle: function () {
        this.axios.get('/bottle-new/api/?_action=getBottle&id='+this.$route.params.id).then((response) => {
          console.log(response)
          this.data = response.data.data;
          this.newComment.postId = this.data.id;
        })
      },
      getComments: function () {
        this.axios.get('/bottle-new/api/?_action=getComments&id='+this.$route.params.id).then((response) => {
          this.comments = response.data.data;
          console.log(this.comments);
        })
      },
      sendComment: function () {
        if(this.newComment.content === '')
          return;
        this.axios.post('/bottle-new/api/?_action=postComment', this.newComment).then((response) => {
          if(response.data.code === 2) {
            console.log(response.data);
            let back_url = '/#' + this.$route.path;
            console.log(back_url);
            let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
            console.log(login_url);
            window.location.href = login_url;
          }
          this.newComment.content = '';
          this.getBottle();
          this.getComments();
        })
      }
    },
    created () {
      document.title = '一个有趣的瓶子'
      this.getBottle();
      this.getComments();
    },
    mounted () {
      console.log('mounted')
    }
  }
</script>

<style>
.details {
  margin-top: 120px;
  margin-bottom: 200px;
}
.da-header {
  height: 100px;
  width: 100%;
  background: rgb(66, 185, 131);
  box-shadow: 0 0 15px rgb(66, 185, 131);
  position: fixed;
  top: 0;
  z-index:1;
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
  padding: 10px 12px;
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
