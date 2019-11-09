import axios from 'axios';

export default {
    state: {
        search: null,
        clients: [],
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
        addClient({ commit }, client) {
            return axios.post('/api/clients', {client: client})
                .then(response => {
                    client.id = response.data.id;
                    commit('addClient', client);
                })
            ;
        },
        findClient({ commit }, id) {
            return axios.get(`/api/clients/${id}`)
                .then(response => {
                    commit('addClient', response.data.client);

                    return response.data.client;
                })
            ;
        }
    },
    getters: {
        clients: state => state.clients,
        clientSearch: state => state.search,
    }
}
