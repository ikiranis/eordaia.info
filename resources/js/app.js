import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin/',
            name: 'home',
            component: Home
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
