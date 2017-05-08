<template>
  <div class="card" @click.self="toDetails(item.id)">
    <div class="header" @click.self="toDetails(item.id)">
      <div class="avatar" :style="{ background: `url(${item.avatar})` }"></div>
      <div class="info">
        <div class="name">{{item.nickname}}</div>
        <div class="date">{{item.date | fromNow}}</div>
      </div>
      <div class="share clickable" @click="share">
        <i class="fa fa-share"></i>
      </div>
    </div>
    <div class="content" @click.self="toDetails(item.id)">
      <router-link :to="`/topics/${topic[1]}`">{{topic[0]}}</router-link>
      <p @click="toDetails(item.id)">{{item.content | getTopic}}</p>
    </div>
    <div class="footer" @click.self="toDetails(item.id)">
      <div class="clickable" @click="like(item.id)">
        <i class="fa" :class="{
          'fa-heart liked': islike,
          'fa-heart-o': !islike
        }"></i>
        <span>{{item.likeCount}}</span>
      </div>
      <div class="clickable" @click="comment(item.id)">
        <i class="fa fa-comment-o"></i>
        <span>{{item.commentCount}}</span>
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
        if(format.test(this.data.content)){
          this.topic = format.exec(this.data.content);
          this.data.content = this.data.content.replace(format , '');
        }else {
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
      let url = '/bottle/api/?_action=getLike&id='+id;
      this.axios.defaults.withCredentials = true
      this.axios.get(url).then((response) => {
        if(response.data.code != undefined){
          if(response.data.code === 2) {
            let back_url = '/#' + this.$route.path;
            let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
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
    if(format.test(this.data.content)){
      this.topic = format.exec(this.data.content);
      this.data.content = this.data.content.replace(format , '');
    }else {
      this.data.topic = ['', '', ''];
    }
  }
}
</script>

<style>
.card {
    position: relative;
    width: calc(100% - 20px);
    max-width: 960px;
    margin: 0 auto 10px;
    padding: 15px 15px 0;
    box-sizing: border-box;
    background-color: #FFF;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
.card .header:after {
    content: '';
    display: block;
    clear: both;
}
.card .header .avatar {
    background-size: cover !important;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    height: 40px;
    width: 40px;
    border-radius: 100%;
    float: left;
}
.card .header .info {
    float: left;
    margin-left: 15px;
    vertical-align: middle;
}
.card .header .info .date {
    color: silver;
}
.card .header .share {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
}
.card .content {
    padding: 10px 0;
}
.card .content p,
.card .content a {
    margin: 3px 0;
}
.card .content a {
    display: block;
    color: #42B983;
}
.card .footer {
    border-top: 1px solid #F1F1F1;
    text-align: right;
}
.card .footer div {
    display: inline-block;
    padding: 10px;
}
.card .footer .liked {
    color: #E53935;
}
</style>
