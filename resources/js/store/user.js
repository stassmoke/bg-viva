export default {
    state: {
        isAuthenticated: false,
        user: {
            userId: null,
            name: null,
        }
    },
    mutations: {
        loginUser(state, user) {
            state.user = user;
            state.isAuthenticated = true;
            localStorage.setItem('user', user);
        },
        logoutUser(state) {
            state.user = null;
            state.isAuthenticated = false;
            localStorage.removeItem('user');
        }
    },
    actions: {
        register(state, payload) {
            console.log(payload)
        },
        login(ctx, payload) {
            ctx.commit('loginUser', payload.user);
        }
    }
}
