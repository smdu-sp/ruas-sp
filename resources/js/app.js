
require('./bootstrap');

window.Vue = require('vue').default;

import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import App from './App.vue';
import VueTheMask from 'vue-the-mask';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueTheMask);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
