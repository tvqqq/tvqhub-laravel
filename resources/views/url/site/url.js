require('../../../js/bootstrap');
import VueRouter from 'vue-router'

window.Vue = require('vue');
Vue.use(VueRouter);

Vue.component('app', require('./components/App').default);

import Home from './components/Home';
import Counter from './components/Counter';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/counter',
            component: Counter
        }
    ]
});

const app = new Vue({
    el: '#app-url',
    router
});
