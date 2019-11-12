import Vue from 'vue';
import VueRouter from 'vue-router';
import vuetify from './plugins/vuetify';
import store from './store.js';
import axios from 'axios';

// import uk from 'vuetify/src/locale/uk'

Vue.use(VueRouter);

const token = localStorage.getItem('token');

if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    store.commit('updateUser', localStorage.getItem('user'));
}

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

router.beforeEach((to, from, next) => {
    store.commit('closeNav');

    if (to.meta.auth && !store.getters.isAuthenticated) {
        next({ name: 'login' });
        return;
    }

    if (!to.meta.auth && store.getters.isAuthenticated) {
        next({ name: 'clients' });
        return;
    }

    next();
});

axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            store.commit('logout');
            router.push({ name: 'login' });
        }

        return Promise.reject(error.response);
    }
);

Vue.prototype.$http = axios;

import App from './views/App'

new Vue({
    store,
    vuetify,
    components: {
        App
    },
    router,
}).$mount('#app');
