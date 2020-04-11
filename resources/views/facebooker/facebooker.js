require('../../js/bootstrap');
import { BootstrapVue } from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(require('vue-moment'));

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-select', require('vue-select2'));
Vue.component('app', require('./App').default);

const app = new Vue({
    el: '#app-facebooker',
});
