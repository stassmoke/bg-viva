import axios from 'axios';

export default {
    state: {
        isAuthenticated: false,
        user: {

        }
    },
    mutations: {
        updateUser(state, user) {
            state.user = user
            if (user) {
                state.isAuthenticated = true
            }
        },
        logout(state, user) {
            state.user = user
            if (!user) {
                state.isAuthenticated = false
            }
        }
    },
    actions: {
        regiterUsers({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/auth/signup', data: payload, method: 'POST' })
                    .then(resp => {
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        loginUser({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/auth/login', data: payload, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.access_token
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
                        commit('updateUser', resp.data)
                        console.log('login');
                        resolve(resp);
                    })
                    .catch(err => {
                        localStorage.removeItem('token')
                        reject(err);
                    })
            })
        },
        getUser({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/auth/user', method: 'GET' })
                    .then(resp => {
                        commit('updateUser', resp.data)
                        console.log('getUser');
                        resolve(resp)
                        

                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                commit('logout')
                console.log('logout');
                localStorage.removeItem('token')
                delete axios.defaults.headers.common['Authorization']
                resolve()
                               
            })
        }
    },

    getters: {
        user(state) {
            return state.user
        },
        isAuthenticated(state) {
            return state.isAuthenticated           
        }
    }
}
