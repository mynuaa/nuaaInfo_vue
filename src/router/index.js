import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/views/Index'
import NewBottle from '@/views/NewBottle'
import Details from '@/views/Details'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index
    },
    {
      path: '/newbottle',
      name: '新建bottle',
      component: NewBottle
    },
    {
      path: '/details',
      name: '详情页',
      component: Details
    }
  ]
})
