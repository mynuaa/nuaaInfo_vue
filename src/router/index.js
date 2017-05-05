import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/views/Index'
import NewBottle from '@/views/NewBottle'
import Details from '@/views/Details'
import Topics from '@/views/Topics'
import Messages from '@/views/Messages'
import MyBottles from '@/views/MyBottles'

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
      path: '/details/:id',
      name: '详情页',
      component: Details
    },
    {
      path: '/topics/:topic',
      name: '话题',
      component: Topics
    },
    {
      path: '/messages',
      name: '消息页',
      component: Messages
    },
    {
      path: '/mybottles',
      name: '我的瓶子',
      component: MyBottles
    }
  ]
})
