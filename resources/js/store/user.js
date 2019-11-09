import axios from 'axios';

export default {
    state: {
        isAuthenticated: false,
        user: {}
    },
    mutations: {
        updateUser(state, user) {
            state.user = user;
            localStorage.setItem('user', state.user);

            if (user) {
                state.isAuthenticated = true;
            }
        },
        logout(state) {
            state.user = null;
            state.isAuthenticated = false;
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            delete axios.defaults.headers.common['Authorization'];
        }
    },
    actions: {
        registerUser({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/signup', payload)
                    .then(resp => {
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
                ;
            });
        },
        loginUser({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/login', payload)
                    .then(resp => {
                        const token = resp.data.access_token;
                        localStorage.setItem('token', token);
                        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                        resolve(resp.data);
                    })
                    .catch(err => {
                        localStorage.removeItem('token');
                        reject(err);
                    })
                ;
            });
        },
        getUser({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('/api/auth/user')
                    .then(resp => {
                        commit('updateUser', resp.data);
                        resolve(resp.data);
                    }).catch(err => reject(err))
                ;
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('/api/auth/logout')
                    .then(response => {
                        commit('logout');
                        resolve(response.data);
                    }).catch(err => reject(err))
                ;
            });
        }
    },

    getters: {
        user: state => state.user,
        isAuthenticated: state => state.isAuthenticated,
    }
}
