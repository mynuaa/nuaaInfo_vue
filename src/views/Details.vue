<template>
  <div class="details index-children">
    <card v-if="data.content" :item="data" class="details-card"></card>
    <div class="comments card">
      <div v-if="!comments || comments.length === 0" class="no-comment">还没有评论……</div>
      <comment v-for="comment in comments" :comment="comment" :key="comment.id"></comment>
    </div>
    <div class="new">
      <input type="text" placeholder="发布评论" v-model="newComment.content">
      <i class="fa fa-paper-plane-o clickable" @click="sendComment"></i>
    </div>
  </div>
</template>

<script>
export default {
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
      this.axios.get('/bottle/api/getBottle?id='+this.$route.params.id).then(response => {
        this.data = response.data.data;
        this.newComment.postId = this.data.id;
      });
    },
    getComments: function () {
      this.axios.get('/bottle/api/getComments?id='+this.$route.params.id).then(response => {
        this.comments = response.data.data;
      });
    },
    sendComment: function () {
      if(this.newComment.content === '') {
        alert('还没有写内容哦……');
        return;
      }
      this.axios.post('/bottle/api/postComment', this.newComment).then(response => {
        this.newComment.content = '';
        this.getComments();
      });
    }
  },
  mounted() {
    window.eventBus.$emit('titleChange', '一个有趣的瓶子');
    this.getBottle();
    this.getComments();
  }
}
</script>

<style>
.details .no-comment {
    padding: 0 0 15px;
}
.details .new {
    position: fixed;
    width: 100%;
    height: 50px;
    bottom: 0;
    padding: 5px 10px;
    box-sizing: border-box;
    background-color: white;
}
.details .new input {
    display: inline-block;
    width: 100%;
    height: 40px;
    padding: 0 12px;
    box-sizing: border-box;
    border-radius: 10px;
    border: 1px solid #DDD;
}
.details .new input:focus {
    border-color: #49BB87;
}
.details .new i {
    position: absolute;
    top: 10px;
    right: 20px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    font-size: 20px;
    text-align: center;
}
.details .comments {
    overflow: hidden;
}
</style>
