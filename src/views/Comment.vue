<template>
  <div class="comment">
    <div class="header">
      <span class="avatar"></span>
      <span class="info">
        <span class="name">{{comment.nickname}}</span>
        <span class="date">{{comment.date | fromNow}}</span>
      </span>
    </div>
    <div class="content">
      <p>{{comment.content}}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    comment: {}
  }
}
</script>

<style>
.comment {
    margin-bottom: 10px;
    border-bottom: 1px solid #F1F1F1;
}
.comment .header span{
    color: black;
}
.comment .header .avatar {
    background: url(http://my.nuaa.edu.cn/ucenter/images/noavatar_middle.gif) no-repeat;
    background-size: cover;
    width: 30px;
    height: 30px;
}
.comment .header .info {
    margin: 5px 0 0 8px;
}
.comment .content {
    padding: 5px 0;
}
</style>
