require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'
import store from './store.js'
import axios from 'axios'

Vue.use(VueRouter);

import App from './views/App'

import Hello from './views/Hello'

import Client from './views/components/Client/Client' 
import NewClient from './views/components/Client/NewClient'


import Login from './views/components/Auth/Login'
import Registration from './views/components/Auth/Registration'


const token = localStorage.getItem('token')

Vue.prototype.$http = axios;

if (token) {

    Vue.prototype.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`

}

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'client',
            component: Client
        },
        {
            path: '/',
            name: 'new-client',
            component: NewClient
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
        },
        

    ],
});

const app = new Vue({
    store,
    vuetify,
    components: { App },
    router,
    // NewClient
}).$mount('#app');
