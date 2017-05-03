// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import 'font-awesome/css/font-awesome.min.css'
import Mint from 'mint-ui'
import 'mint-ui/lib/style.min.css'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Moment from 'moment'

Object.defineProperty(Vue.prototype, '$moment', {value: Moment});
Vue.prototype.$moment.locale('zh-cn');
Vue.use(VueAxios, axios);
Vue.use(Mint);
Vue.config.productionTip = false

Vue.filter('fromNow', function(value){
  return Moment(value, 'X').fromNow();
})
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
