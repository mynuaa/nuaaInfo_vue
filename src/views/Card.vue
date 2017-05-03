<template>
  <div class="card">
    <div class="header">
      <span class="avatar"></span>
      <span class="info">
        <span class="name">某同学</span>
        <span class="date">一天前</span>
      </span>
      <span class="share">
        <i class="fa fa-share fa-2x"></i>
      </span>
    </div>
    <div class="content" @click="toDetails()">
      <p>
        于老板是我的RBQ
      </p>
    </div>
    <div class="footer">
      <span class="like" @click="like()">
        <i class="fa fa-heart fa-4x"></i>
      </span>
      <span class="comment" @click="comment">
        <i class="fa fa-comment fa-4x"></i>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    toDetails: function () {
      this.$router.push('/details');
    },
    like: function () {
      console.log('stop here')
    },
    comment: function () {
      this.$router.push('/details')
    }
  }
}
</script>

<style>
  .card {
    min-height: 500px;
    width: 100%;
    background-color: dimgray;
    padding-top: 1px;
    padding-bottom: 1px;
    position: relative;
  }
  .header span {
    display: inline-block;
    color: white;
    font-size: 1.8rem;
  }
  .header {
    width: 95%;
    padding: 23px;
    position: absolute;
  }
  .avatar {
    background-color: white;
    height: 100px;
    width: 100px;
    border-radius: 100%;
  }
  .info {
    height: 100px;
    width: 130px;
    vertical-align: top;
    margin-left: 20px;
  }
  .info span {
    width: 130px;
  }
  .share {
    vertical-align: top;
    float: right;
    padding: 4px;
  }
  .content {
    margin: 127px 20px;
    padding: 50px;
    min-height: 200px;
  }
  .content>p{
    width: 100%;
    display: inline-block;
    font-size: 2rem;
    color: white;
    -webkit-margin-before: 0;
    -webkit-margin-after: 0;
  }

  .footer {
    min-height: 80px;
    width: 100%;
    margin: 0 20px 20px 0;
    position: absolute;
    bottom: 0;
  }
  .footer > span {
    color: white;
    float: right;
    padding: 0 35px 0 40px;
  }
</style>
