import axios from 'axios';

export default {
    state: {
        search: null,
        isLoaded: false,
        perPage: 15,
        page: 1,
        total: 0,
        sortBy: 'clients.contract_date',
        sortDirection: 'DESC',
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
        setClients(state, pagination) {
            state.clients = pagination.data;
            state.total = pagination.total;
            state.isLoaded = true;
        },
        updateClientsPerPage(state, perPage) {
            state.perPage = perPage;
        },
        updateClientsPage(state, page) {
            state.page = page;
        },
        updateClientLoaded(state, status) {
            state.isLoaded = status;
        },
        updateClientsSort(state, sortBy) {
            state.sortBy = sortBy;
        },
        updateClientsSortDirection(state, direction) {
            state.sortDirection = direction;
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
        getClients({ commit, getters }) {
            commit('updateClientLoaded', false);

            return new Promise((resolve, reject) => {
                const params = {
                    page: getters.clientsPage,
                    perPage: getters.clientsPerPage,
                    term: getters.clientSearch,
                    orderBy: getters.clientsSortBy,
                    sortDirection: getters.clientsSortDirection,
                };

                axios.get(`/api/clients`, { params: params })
                    .then(response => {
                        commit('setClients', response.data);
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
        clientsPerPage: state => state.perPage,
        clientsPage: state => state.page,
        clientsTotal: state => state.total,
        clientsSortBy: state => state.sortBy,
        clientsSortDirection: state => state.sortDirection,
    }
}
