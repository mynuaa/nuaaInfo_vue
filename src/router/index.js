import Vue from 'vue';
import Router from 'vue-router';
import Index from '@/views/Index';
import NewBottle from '@/views/NewBottle';
import Details from '@/views/Details';
import Topics from '@/views/Topics';
import Messages from '@/views/Messages';
import MyBottles from '@/views/MyBottles';

Vue.use(Router);

export default new Router({
    routes: [{
        path: '/',
        name: 'index',
        component: Index,
        children: [{
            path: '/newbottle',
            name: 'newbottle',
            component: NewBottle
        }, {
            path: '/details/:id',
            name: 'details',
            component: Details
        }, {
            path: '/topics/:topic',
            name: 'topics',
            component: Topics
        }, {
            path: '/messages',
            name: 'messages',
            component: Messages
        }, {
            path: '/mybottles',
            name: 'mybottles',
            component: MyBottles
        }]
    }]
});
