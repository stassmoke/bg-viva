require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'


import vuetify from './plugins/vuetify'

Vue.use(Vuex);
Vue.use(VueRouter);

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import Login from './views/components/Auth/Login'
import Registration from './views/components/Auth/Registration'




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
            path: '/Registration',
            name: 'register',
            component: Registration,
        }
    ],
});

const app = new Vue({
    vuetify,
    components: { App },
    router,
}).$mount('#app');
