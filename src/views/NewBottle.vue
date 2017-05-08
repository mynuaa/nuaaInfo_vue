<template>
  <div class="newBottle">
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
import DaSwitch from '@/components/DaSwitch'
import RsSelect from '@/components/rs-select'

export default {
  components: {
    DaSwitch,
    RsSelect
  },
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
      placeholder: '加一个话题吧...',
      topic: {
        label: '每日一瓶',
        value: '每日一瓶'
      }
    }
  },
  methods: {
    newBottle: function () {
      if(this.content === '') {
        return false;
      }
      if (this.topic && this.topic.value !== '') {
        this.bottle.content = `#${this.topic.value}# ${this.bottle.content}`;
      }
      this.axios.post('/bottle-new/api/?_action=postBottle', this.bottle).then(response => {
        if(response.data.code === 2) {
          let back_url = '/' + this.$route.path;
          let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
          window.location.href = login_url;
        } else {
          this.$router.go('/');
        }
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
.newBottle {
    width: calc(100% - 20px);
    margin: auto;
}
.newBottle textarea,
.newBottle .da-form,
.newBottle .nameless,
.newBottle .submit {
    width: 100%;
    display: block;
    box-sizing: border-box;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
.newBottle textarea {
    height: 10em;
    margin: 0 auto 10px;
    padding: 10px;
    font-size: 14px;
    border: none;
    resize: none;
}
.newBottle .dropdown-toggle {
    border: none !important;
    border-bottom: 1px solid #DDD !important;
    border-radius: 0 !important;
}
.newBottle .dropdown i {
    display: none;
}
.newBottle .dropdown .selected-tag {
    background: #49BB87;
    color: #FFF;
    border: none;
    font-size: 13px;
    margin: 2px 3px 0 0;
    padding: 4px 5px !important;
}
.newBottle .da-form {
    background: #FFF;
    margin: 0 auto 10px;
    padding: 10px;
}
.newBottle .nameless {
    overflow: hidden;
}
.newBottle .nameless > div {
    float: left;
    width: 50%;
}
.newBottle .nameless > div > span,
.newBottle .nameless > div > .switch {
    vertical-align: middle;
}
.newBottle .submit {
    font-size: 14px !important;
    margin-bottom: 10px;
}
</style>
