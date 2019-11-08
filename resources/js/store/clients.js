import axios from 'axios';

export default {
    state: {
        search: null,

        clients: [
            
        ],

    },
    mutations: {
        addClient(state, client) {
            state.clients.unshift(client);
        },

        updateClientSearch(state, search) {
          state.search = search;
        },
    },
    actions: {
        addClient({ commit }, payload) {
            commit('addClient', payload);
        },

    },
    getters: {
        clients: state => state.clients,

        clientSearch: state => state.search,
    }
}