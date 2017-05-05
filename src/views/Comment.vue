<template>
  <div class="card comment">
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
  margin-bottom: 22px;
  background-color: #fff;
  padding: 20px 40px;
}
.comment .header span{
  color: black;
}
.comment .header .avatar {
  box-shadow: 0 0 15px grey;
}
.comment .content p {
  color: #000;
}

</style>
