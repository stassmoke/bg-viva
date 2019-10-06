require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'
import store from './store.js'

Vue.use(VueRouter);

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import Login from './views/components/Auth/Login'



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/clients/create',
            name: 'clients.create',
            component: Hello,
        }
    ],
});

const app = new Vue({
    store,
    vuetify,
    components: { App },
    router,
}).$mount('#app');
