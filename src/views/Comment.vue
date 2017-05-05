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
    <hr>
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
  margin-top: 4rem;
  background-color: #fff;
}
.comment .header span{
  color: black;
}
.comment .content p {
  color: #000;
}

</style>
