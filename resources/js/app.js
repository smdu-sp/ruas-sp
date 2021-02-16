
require('./bootstrap');

window.Vue = require('vue').default;

import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import App from './App.vue';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
