<template>
  <div class="card" @click.self="toDetails()">
    <div class="header" @click.self="toDetails()">
      <div class="avatar" :style="{ background: `url(${item.avatar})` }"></div>
      <div class="info">
        <div class="name">{{item.nickname}}</div>
        <div class="date">{{item.date | fromNow}}</div>
      </div>
      <div class="share clickable" @click="share">
        <i class="fa fa-share"></i>
      </div>
    </div>
    <div class="content" @click.self="toDetails()">
      <router-link :to="topic.link" v-for="topic in topics" :key="topic.id">{{topic.content}}</router-link>
      <p @click="toDetails()">{{item.content}}</p>
    </div>
    <div class="footer" @click.self="toDetails()">
      <div class="clickable" @click="like()">
        <i class="fa" :class="{
          'fa-heart liked': item.isLiked,
          'fa-heart-o': !item.isLiked
        }"></i>
        <span>{{item.likeCount}}</span>
      </div>
      <div class="clickable" @click="comment()">
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
  data() {
    return {
      data: this.item,
      topics: []
    }
  },
  methods: {
    toDetails: function () {
      this.$router.push(`/details/${this.item.id}`);
    },
    like: function () {
      if (this.item.isLiked) {
        return false;
      }
      if (window.bottle.userLogged()) {
        this.axios.get(`/bottle/api/?_action=getLike&id=${this.item.id}`).then(response => {
          this.item.likeCount++;
          this.item.isLiked = true;
        });
      }
    },
    comment: function () {
      if (window.bottle.userLogged()) {
        this.$router.push(`/details/${this.item.id}`);
      }
    },
    share: function () {
      const back_url = encodeURIComponent(window.location.href);
      const title = '南航Bottle';
      const summary = encodeURIComponent(this.item.content);
      const site = 'my.nuaa.edu.cn';
      const pics = encodeURIComponent(this.item.avatar);
      const share_url = 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+back_url+'&title='+title+'&desc=&summary='+summary+'&site='+site+'&pics='+pics;
      window.location.href = share_url;
    }
  },
  mounted() {
    const re = /#(.+?)#/g;
    const topics = this.item.content.match(re);
    if (topics) {
      let id = 0;
      for (let topic of topics) {
        topic = topic.slice(1, topic.length - 1);
        this.topics.push({
          id: ++id,
          content: `#${topic}# `,
          link: `/topics/${topic}`
        });
      }
    }
    this.item.content = this.item.content.replace(re, '').trim();
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
    min-height: 20px;
    white-space: pre-wrap;
    word-break: break-all;
}
.card .content p:empty,
.card .content a:empty {
    margin: 0;
}
.card .content a {
    display: inline-block;
    color: #42B983;
    margin: 0 3px;
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
