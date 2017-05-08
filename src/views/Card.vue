<template>
  <div class="card">
    <div class="header">
      <span class="avatar" :style="{background: 'url('+ item.avatar +')'}"></span>
      <span class="info">
        <span class="name">{{item.nickname}}</span>
        <span class="date">{{item.date | fromNow}}</span>
      </span>
      <span class="share" @click="share">
        <i class="fa fa-share fa-1x"></i>
      </span>
    </div>
    <div class="content">
      <router-link :to="{'path': '/topics/'+topic[1]}">{{topic[0]}}</router-link>
      <p @click="toDetails(item.id)">{{item.content | getTopic}}</p>
    </div>
    <div class="footer">
      <div class="like">
        <i class="fa fa-heart fa-2x like" @click="like(item.id)" :class="{'likeit': islike, '': !islike}"></i>
        <span class="like-nums">{{item.likeCount}}</span>
      </div>
      <div class="toComment">
        <i class="fa fa-comment fa-2x commentit" @click="comment(item.id)"></i>
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
      data: this.item,
      islike: false,
      topic: ['', '', '']
    }
  },
  watch: {
      data: function () {
        let format = /^#(.+)#/;
        console.log(this.data);
        if(format.test(this.data.content)){
          console.log('here')
          this.topic = format.exec(this.data.content);
          this.data.content = this.data.content.replace(format , '');
        }else {
          console.log('no format')
          this.data.topic = ['', '', ''];
        }
      }
  },
  filters: {
    getTopic: function (val, topic) {
      let format = /^#(.+)#/;
      if(format.test(val)){
        val = val.replace(format , '');
        return val;
      }
      return val
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
          this.item.likeCount++;
        }
      })
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
      window.location.href = share_url;
    }
  },
  mounted: function () {
    let format = /^#(.+)#/;
    console.log(this.data);
    if(format.test(this.data.content)){
      console.log('here')
      this.topic = format.exec(this.data.content);
      this.data.content = this.data.content.replace(format , '');
    }else {
      console.log('no format')
      this.data.topic = ['', '', ''];
    }
  }
}
</script>

<style>
  .card {
    background-color: #f1f1f1;
    position: relative;
    padding: 20px 20px 0 20px;
    margin: 0 auto 10px;
    box-shadow: 0 0 15px #8e8e8e;
    max-width:960px;
    width: 100%;
  }
  .header span {
    color: black;
    padding: 0;
  }
  .avatar {
    background-color: white;
    height: 40px;
    width: 40px;
    border-radius: 100%;
    display: inline-block;
  }
  .info {
    height: 44px;
    width: 80%;
    vertical-align: top;
    margin-left: 20px;
    display: inline-block;
  }
  .like {
    color: #354e61;
  }
  .commentit {
    color: #354e61;
  }
  .info span {
    width: 100%;
  }
  .info .date {
    color: #B3B3B3;
    padding-top: 10px;
    margin-left: 20px;
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
    color: black;
    margin: 5px 0;
  }
  .content a{
    display: inline-block;
    margin-top: 3px;
    color: limegreen;
  }
/*评论点赞*/
  .footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    color: white;
    padding: 5px 0;
    border-top: 0.5px solid ghostwhite;
  }
  .footer div {
    display: inline-block;
  }
  .like, .toComment{
    margin: 10px 0 0 10px;
  }
  .like-nums, .comment-nums {
    margin: 10px 0 0 10px;
  }
  .likeit {
    color: red;
  }
</style>
