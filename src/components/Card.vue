<template>
  <div class="card">
    <div class="header">
      <span class="avatar"></span>
      <span class="info">
        <span class="name">某同学</span>
        <span class="date">一天前</span>
      </span>
      <span class="share">
        <i class="fa fa-share fa-3x"></i>
      </span>
    </div>
    <p class="content">
      于老板是我的RBQ
    </p>
    <div class="footer">
      <span class="like">
        <i class="fa fa-heart fa-4x"></i>
      </span>
      <span class="comment">
        <i class="fa fa-comment fa-4x"></i>
      </span>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
  .card {
    min-height: 500px;
    width: 100%;
    background-color: dimgray;
    padding-top: 1px;
  }
  .header span {
    display: inline-block;
    color: white;
    font-size: 1.5em;
  }
  .header {
    min-height: 200px;
    margin: 20px 30px 10px 30px;
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
    width: 100%;
    height: 300px;
    display: inline-block;
    font-size: 60px;
    text-align: center;
    margin: 0;
    color: white;
  }

  .footer {
    min-height: 80px;
    width: 100%;
    margin-right: 20px;
  }
  .footer > span {
    color: white;
    float: right;
    padding: 0 20px 0 40px;
  }
</style>
