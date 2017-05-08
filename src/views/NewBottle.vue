  <template>
    <div class="newBottle">
      <form>
        <div class="textarea">
          <textarea v-model="bottle.content" class="newInput" placeholder="写下你想说的话"></textarea>
        </div>
        <div class="da-form">
          <label for="newTopic">话题</label>
          <!--<rs-select :options="topicOp" :value="topic" :placeholder="placeholder"></rs-select>-->
          <select v-model="topic" class="newTopic" id="newTopic">
            <option>你有我没有</option>
            <option>我最想对你说</option>
            <option>我对南航说</option>
            <option>对学弟学妹们的忠告</option>
          </select>
        </div>
        <div class="nameless da-form">
          <span>匿名</span>
          <da-switch v-model="bottle.secret"></da-switch>
        </div>
        <div class="sex da-form">
          <span v-if="bottle.gender">男</span>
          <span v-else="bottle.gender">女</span>
          <da-switch v-model="bottle.gender"></da-switch>
        </div>
      </form>
      <div class="action">
        <mt-button type="danger" class="da-button" @click="back()">取消</mt-button>
        <mt-button type="primary" class="da-button" @click="newBottle()">确认</mt-button>
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
        topicOp: [
          '你有我没有',
          '我对南航说',
          '我最想对你说',
          '对学弟学妹的忠告'
        ],
        placeholder: '可以选择一个主题哦',
        topic: '我对南航说'
      }
    },
    methods: {
      newBottle: function () {
        console.log(this.bottle);
        if(this.content === '')
          return;
        this.bottle.content = '#'+this.topic+'#'+ this.bottle.content;
        this.axios.post('/bottle-new/api/?_action=postBottle', this.bottle).then((response) => {
          if(response.data.code === 2) {
            console.log(response.data);
            let back_url = '/#' + this.$route.path;
            console.log(back_url);
            let login_url = '/sso/?page=login&redirect_uri=' + btoa(back_url);
            console.log(login_url);
            window.location.href = login_url;
          }
          console.log(response.data)
          this.$router.go('/#');
        })
      },
      back: function () {
        this.$router.back(-1);
      }
    },
    created () {
      document.title = '新建 Bottle'
    }
  }
  </script>

  <style>
  .newBottle{
    width: 100%;
    margin-top: 40px;
  }
  .textarea {
    text-align: center;
    padding: 10px 20px 10px 20px;
    border: 1px solid lightgray;
    width: 100%;
  }
  textarea {
    border: none;
    outline: none;
  }
  .newTopic {
    height: 4rem;
    vertical-align: middle;
  }
  .newTopic option {
    font-size: 0.5rem;
  }
  .newInput {
    width: 95%;
    min-height: 300px;
    padding: 8px;
    margin-left: 1.5%;
    font-size: 1.5rem !important;
  }
  .da-form span {
    vertical-align: top;
    line-height: 90px;
  }
  .da-form {
    margin: 20px;
    display: inline-block;
    width: 100%;
  }
  .nameless, .sex{
    width: 40%;
  }
  .da-button {
    width: 200px;
    height: 100px!important;
    font-size: 1.2rem!important;
    margin: 50px;
  }
  .action {
    text-align: center;

  }
  </style>
