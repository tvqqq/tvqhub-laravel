require('../../js/bootstrap');
import { BootstrapVue } from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-select', require('vue-select2'));

Vue.component('app', require('./App').default);

import Auto from "./components/Auto";
import List from "./components/List";

const app = new Vue({
    el: '#app-facebooker',
});
