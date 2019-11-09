import Vue from 'vue';
import VueRouter from 'vue-router';
import vuetify from './plugins/vuetify';
import store from './store.js';
import axios from 'axios';

Vue.use(VueRouter);

Vue.prototype.$http = axios;

const token = localStorage.getItem('token');

if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    store.commit('updateUser', localStorage.getItem('user'));
}

Vue.prototype.$http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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

import App from './views/App'

new Vue({
    store,
    vuetify,
    components: {
        App
    },
    router,
}).$mount('#app');
