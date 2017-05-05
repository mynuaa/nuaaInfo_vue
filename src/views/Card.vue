<template>
  <div class="card">
    <div class="header">
      <span class="avatar"></span>
      <span class="info">
        <span class="name">{{item.nickname}}</span>
        <span class="date">{{item.date | fromNow}}</span>
      </span>
      <span class="share" @click="share">
        <i class="fa fa-share fa-1x"></i>
      </span>
    </div>
    <div class="content">
      <router-link :to="{'path': '/topics/'+item.topic[1]}">{{item.topic[0]}}</router-link>
      <p @click="toDetails(item.id)">{{item.content}}</p>
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
      islike: false,
      thetopic: ''
    }
  },
  methods: {
    toDetails: function (id) {
      this.$router.push('/details/' + id);
    },
    like: function (id) {
      let url = '/bottle-new/api/?_action=getLike&id='+id;
      this.axios.defaults.withCredentials = true
      this.axios.get(url).then((response) => {
        if(response.data.code != undefined){
          if(response.data.code === 2) {
            console.log(response.data);
            let back_url = '/#' + this.$route.path;
            console.log(back_url);
            let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
            console.log(login_url);
            window.location.href = login_url;
          }
          this.islike = true;
          this.item.islike++;
        }
      })
      console.log('stop here')
    },
    comment: function (id) {
      this.$router.push('/details/' + id)
    },
    share: function () {
      console.log('to share')
      let back_url = encodeURIComponent(window.location.href);
      let title = '南航Bottle';
      let summary = encodeURIComponent(this.item.title);
      let site = 'my.nuaa.edu.cn';
      let pics = encodeURIComponent(this.item.avatar);
      let share_url = 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+back_url+'&title='+title+'&desc=&summary='+summary+'&site='+site+'&pics='+pics;
      console.log('+++++++++++++++++++++++++++++++++');
      console.log(share_url)
      window.location.href = share_url;
    }
  },
  created () {
    let format = /^#(.+)#/;
    if(format.test(this.item.content)){
      this.item.topic = format.exec(this.item.content);
      this.item.content = this.item.content.replace(format , '');
    }else {
      this.item.topic = ['', ''];
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
  .content p, .content a{
    font-size: 2rem;
    color: white;
  }
  .content a{
    display: inline-block;
    margin-top: 30px;

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
