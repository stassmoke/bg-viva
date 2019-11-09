import axios from 'axios';

export default {
    state: {
        search: null,
        isLoaded: false,
        clients: [],
    },
    mutations: {
        addClient(state, client) {
            state.clients.unshift(client);
        },
        updateClient(state, client) {
            const indexOfClient = state.clients.findIndex(foundClient => foundClient.id === client.id);

            if (indexOfClient === -1) {
                return;
            }

            state.clients[indexOfClient] = client;
        },
        updateClientSearch(state, search) {
          state.search = search;
        },
        setClients(state, clients) {
            state.clients = clients;
            state.isLoaded = true;
        },
    },
    actions: {
        addClient({ commit }, client) {
            return new Promise((resolve, reject) => {
                axios.post('/api/clients', {client: client})
                    .then(response => {
                        client.id = response.data.id;
                        commit('addClient', client);
                        resolve(client);
                    }).catch(err => reject(err))
                ;
            });
        },
        updateClient({ commit }, client) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/clients/${client.id}`, {client: client})
                    .then(() => {
                        commit('updateClient', client);
                        resolve(client);
                    }).catch(err => reject(err))
                ;
            });
        },
        findClient({}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/clients/${id}`)
                    .then(response => {
                        resolve(response.data.client);
                    }).catch(err => reject(err))
                ;
            });
        },
        getClients({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/clients`)
                    .then(response => {
                        commit('setClients', response.data.data);
                        resolve(response.data.data);
                    }).catch(err => reject(err))
                ;
            });
        },
    },
    getters: {
        clients: state => state.clients,
        clientSearch: state => state.search,
        isLoadedClients: state => state.isLoaded,
    }
}
