import axios from 'axios';

export default {
    state: {
        search: null,

        calls: [
            
        ],
    },
    mutations: {
        addCall(state, call) {
            state.calls.unshift(call);
        },
        updateCall(state, call) {
            const indexOfCall = state.calls.findIndex(foundCall => foundCall.id === call.id);

            if (indexOfCall === -1) {
                return;
            }

            state.calls[indexOfCall] = call;
        },
        updateCallSearch(state, search) {
          state.search = search;
        },
        setCalls(state, pagination) {
            state.calls = pagination.data;
            state.total = pagination.total;
            state.isLoaded = true;
        },
        updateCallsPerPage(state, perPage) {
            state.perPage = perPage;
        },
        updateCallsPage(state, page) {
            state.page = page;
        },
        updateCallLoaded(state, status) {
            state.isLoaded = status;
        },
        updateCallsSort(state, sortBy) {
            state.sortBy = sortBy;
        },
        updateCallsSortDirection(state, direction) {
            state.sortDirection = direction;
        },
    },
    actions: {
        addCall({ commit }, call) {
            return new Promise((resolve, reject) => {
                axios.post('/api/calls', {call: call})
                    .then(response => {
                        call.id = response.data.id;
                        commit('addCall', call);
                        resolve(call);
                    }).catch(err => reject(err))
                ;
            });
        },
        updateCall({ commit }, call) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/calls/${call.id}`, {call: call})
                    .then(() => {
                        commit('updateCall', call);
                        resolve(call);
                    }).catch(err => reject(err))
                ;
            });
        },
        findCall({}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/calls/${id}`)
                    .then(response => {
                        resolve(response.data.call);
                    }).catch(err => reject(err))
                ;
            });
        },
        getCalls({ commit, getters }) {
            commit('updateCallLoaded', false);

            return new Promise((resolve, reject) => {
                const params = {
                    page: getters.callsPage,
                    perPage: getters.callsPerPage,
                    term: getters.callSearch,
                    orderBy: getters.callsSortBy,
                    sortDirection: getters.callsSortDirection,
                };

                axios.get(`/api/calls`, { params: params })
                    .then(response => {
                        commit('setCalls', response.data);
                        resolve(response.data.data);
                    }).catch(err => reject(err))
                ;
            });
        },
    },
    getters: {
        calls: state => state.calls,
        callSearch: state => state.search,
        isLoadedCalls: state => state.isLoaded,
        callsPerPage: state => state.perPage,
        callsPage: state => state.page,
        callsTotal: state => state.total,
        callsSortBy: state => state.sortBy,
        callsSortDirection: state => state.sortDirection,
    }
}