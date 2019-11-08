require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'
import store from './store.js'
import axios from 'axios'

Vue.use(VueRouter);

import App from './views/App'


import Client from './views/components/Client/Client' 
import NewClient from './views/components/Client/NewClient'
import TableClients from './views/components/Client/TableClients'


import Call from './views/components/Call/Call'
import NewCall from './views/components/Call/NewCall'
import TableCall from './views/components/Call/TableCall'

import Meetings from './views/components/Meeting/Meeting'
import NewMeeting from './views/components/Meeting/NewMeeting'
import TableMeeting from './views/components/Meeting/TableMeeting'



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
            path: '/clients',
            name: 'clients',
            component: Client,
            children: [
                {
                    path: '',
                    component: TableClients,
                },
                {
                    path: 'new',
                    component: NewClient,
                },
            ]
        },
        {
            path: '/call',
            name: 'call',
            component: Call,
            children: [
                {
                    path: '',
                    component: TableCall,
                },
                {
                    path: 'new',
                    component: NewCall,
                },
            ]
        },
        {
            path: '/meetings',
            name: 'meetings',
            component: Meetings,
            children: [
                {
                    path: '',
                    component: TableMeeting,
                },
                {
                    path: 'new',
                    component: NewMeeting,
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/registration',
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
}).$mount('#app');
