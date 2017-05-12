<template>
  <div class="new-bottle index-children">
    <textarea v-model="bottle.content" class="newInput" placeholder="我想说的是..."></textarea>
    <div class="da-form">
      <label for="newTopic">话题</label>
      <rs-select v-model="topic" :options="topics"></rs-select>
    </div>
    <div class="da-form nameless">
      <div>
        <span v-if="bottle.secret">我要匿名</span>
        <span v-else="bottle.secret">我要实名</span>
        <da-switch v-model="bottle.secret"></da-switch>
      </div>
      <div>
        <span v-if="bottle.gender">我是汉子</span>
        <span v-else="bottle.gender">我是妹子</span>
        <da-switch v-model="bottle.gender"></da-switch>
      </div>
    </div>
    <div class="action">
      <mt-button type="primary" class="da-button submit" @click="newBottle()">发送</mt-button>
      <mt-button type="danger" class="da-button submit" @click="$router.go(-1)">返回</mt-button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      bottle: {
        content: '',
        secret: 1,
        gender: 1
      },
      topics: [{
        label: '每日一瓶',
        value: '每日一瓶'
      }, {
        label: '你有我没有',
        value: '你有我没有'
      }, {
        label: '我对南航说',
        value: '我对南航说'
      }, {
        label: '我最想对你说',
        value: '我最想对你说'
      }, {
        label: '对学弟学妹的忠告',
        value: '对学弟学妹的忠告'
      }],
      placeholder: '这里是常用话题...',
      topic: {
        label: '每日一瓶',
        value: '每日一瓶'
      }
    }
  },
  methods: {
    newBottle: function () {
      if(this.bottle.content === '') {
        alert('内容是空的...');
        return false;
      }
      if (this.topic && this.topic.value !== '') {
        this.bottle.content = `#${this.topic.value}# ${this.bottle.content}`;
      }
      this.axios.post('/bottle/api/postBottle', this.bottle).then(response => {
        window.eventBus.$emit('indexRefresh');
        this.$router.push('/');
      });
      return false;
    }
  },
  mounted() {
    window.eventBus.$emit('titleChange', '扔一个瓶子');
  }
}
</script>

<style>
.new-bottle {
    width: calc(100% - 20px);
    margin: auto;
}
.new-bottle textarea,
.new-bottle .da-form,
.new-bottle .nameless,
.new-bottle .submit {
    width: 100%;
    display: block;
    box-sizing: border-box;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
.new-bottle textarea {
    height: 10em;
    margin: 0 auto 10px;
    padding: 10px;
    font-size: 14px;
    border: none;
    resize: none;
}
.new-bottle .dropdown-toggle {
    border: none !important;
    border-bottom: 1px solid #DDD !important;
    border-radius: 0 !important;
}
.new-bottle .dropdown i {
    display: none;
}
.new-bottle .dropdown .selected-tag {
    background: #49BB87;
    color: #FFF;
    border: none;
    font-size: 13px;
    margin: 2px 3px 0 0;
    padding: 4px 5px !important;
}
.new-bottle .da-form {
    background: #FFF;
    margin: 0 auto 10px;
    padding: 10px;
}
.new-bottle .nameless {
    overflow: hidden;
}
.new-bottle .nameless > div {
    float: left;
    width: 50%;
}
.new-bottle .nameless > div > span,
.new-bottle .nameless > div > .switch {
    vertical-align: middle;
}
.new-bottle .submit {
    margin-bottom: 10px;
}
</style>
