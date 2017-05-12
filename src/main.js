// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import App from './App';
import router from './router';
import Mint from 'mint-ui';
import Moment from 'moment';
import axios from 'axios';
import VueAxios from 'vue-axios';
import vSelect from 'vue-select';
import DaSwitch from 'components/DaSwitch';
import RsSelect from 'components/rs-select';
import BottleHeader from 'components/bottle-header';
import BottleFooter from 'components/bottle-footer';
import LoadingPlaceholder from 'components/loading-placeholder';
import PaletteButton from 'components/PaletteButton';
import Card from 'components/Card';
import Comment from 'components/Comment';

import 'font-awesome/css/font-awesome.min.css';
import 'mint-ui/lib/style.min.css';

Object.defineProperty(Vue.prototype, '$moment', {value: Moment});
Vue.prototype.$moment.locale('zh-cn');

Vue.use(VueAxios, axios);
Vue.use(Mint);
Vue.config.productionTip = false;

Vue.component('v-select', vSelect);
Vue.component('rs-select', RsSelect);
Vue.component('da-switch', DaSwitch);
Vue.component('bottle-header', BottleHeader);
Vue.component('bottle-footer', BottleFooter);
Vue.component('loading-placeholder', LoadingPlaceholder);
Vue.component('card', Card);
Vue.component('comment', Comment);
Vue.component('palette-button', PaletteButton);

Vue.filter('fromNow', function (value) {
    return Moment(value, 'X').fromNow();
});

window.eventBus = new Vue();

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
});
