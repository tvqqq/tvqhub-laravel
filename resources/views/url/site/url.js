require('../../../js/bootstrap');
import VueRouter from 'vue-router'

window.Vue = require('vue');
Vue.use(VueRouter);

Vue.component('app', require('./App').default);
Vue.component('validation-errors', require('../../../js/components/ValidationErrorsComponent').default);

import Home from './components/Home';
import Counter from './components/Counter';
import NotFound from './components/404';

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
        },
        {
            path: '*',
            component: NotFound
        },
    ]
});

const app = new Vue({
    el: '#app-url',
    router
});
