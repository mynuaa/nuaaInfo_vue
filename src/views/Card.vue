<template>
  <div class="card">
    <div class="header">
      <span class="avatar"></span>
      <span class="info">
        <span class="name">{{item.nickname}}</span>
        <span class="date">{{item.date | fromNow}}</span>
      </span>
      <span class="share">
        <i class="fa fa-share fa-1x"></i>
      </span>
    </div>
    <div class="content" @click="toDetails(item.id)">
      <p>{{item.content}}</p>
    </div>
    <div class="footer">
      <div class="like">
        <i class="fa fa-heart fa-2x" @click="like(item.id)" :class="{'likeit': islike, '': !islike}"></i>
        <span class="like-nums">{{item.islike}}</span>
      </div>
      <div class="toComment">
        <i class="fa fa-comment fa-2x" @click="comment(item.id)"></i>
        <span class="comment-nums">{{item.commentCount}}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: Object
  },
  data () {
    return {
      islike: false
    }
  },
  methods: {
    toDetails: function (id) {
      this.$router.push('/details/' + id);
    },
    like: function (id) {
      let url = 'bottle-new/api/?_action=getLike&id='+id;
      this.axios.defaults.withCredentials = true
      this.axios.get(url).then((response) => {
        console.log(response)
        if(response.data.code != undefined){
          if(response.data.code === 2) {
            console.log(response.data);
            let back_url = 'http://localhost:8080/#' + this.$route.path;
            console.log(back_url);
            let login_url = 'http://my.nuaa.edu.cn/sso/?page=login&redirect_uri=' + btoa(back_url);
            console.log(login_url);
            //window.location.href = login_url;
          }
          this.islike = true;
          this.item.islike++;
        }
      })
      console.log('stop here')
    },
    comment: function (id) {
      this.$router.push('/details/' + id)
    }
  }
}
</script>

<style>
  .card {
    background-color: dimgray;
    position: relative;
    padding: 20px 40px 0 40px;
    margin-bottom: 60px;
  }
  .header span {
    display: inline-block;
    color: white;
    font-size: 1.8rem;
  }
  .avatar {
    background-color: white;
    height: 100px;
    width: 100px;
    border-radius: 100%;
  }
  .info {
    height: 100px;
    width: 260px;
    vertical-align: top;
    margin-left: 20px;
  }
  .info span {
    width: 260px;
  }
  .info .date {
    color: lightgray;
    padding-top: 10px;
  }
  .share {
    vertical-align: top;
    float: right;
    padding: 4px;
  }
  /*内容部分*/
  .content {
  }
  .content p{
    display: inline-block;
    font-size: 2rem;
    color: white;
  }
/*评论点赞*/
  .footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    color: white;
    padding: 20px 0;
    border-top: 0.5px solid ghostwhite;
  }
  .footer div {
    display: inline-block;
  }
  .like, .toComment{
    margin: 20px 0 0 20px;
  }
  .like-nums, .comment-nums {
    font-size: 2rem;
    margin: 20px 0 0 20px;
  }
  .likeit {
    color: red;
  }
</style>
