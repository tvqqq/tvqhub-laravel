require('../../js/bootstrap');

window.Vue = require('vue');

Vue.component('app', require('./App').default);

const app = new Vue({
    el: '#app-facebooker',
});
