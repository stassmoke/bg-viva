import axios from 'axios';

export default {
    state: {
        search: null,
        isLoaded: false,
        perPage: 15,
        page: 1,
        total: 0,
        sortBy: 'recivable.contract_date',
        sortDirection: 'DESC',
        recivables: [],
    },
    mutations: {
        addRecivable(state, recivable) {
            state.recivables.unshift(recivable);
        },
        updateRecivable(state, recivable) {
            const indexOfRecivable = state.recivables.findIndex(foundRecivable => foundRecivable.id === recivable.id);

            if (indexOfRecivable === -1) {
                return;
            }

            state.recivables[indexOfRecivable] = recivable;
        },
        updateRecivableSearch(state, search) {
          state.search = search;
        },
        setRecivables(state, pagination) {
            state.recivables = pagination.data;
            state.total = pagination.total;
            state.isLoaded = true;
        },
        updateRecivablesPerPage(state, perPage) {
            state.perPage = perPage;
        },
        updateRecivablesPage(state, page) {
            state.page = page;
        },
        updateRecivableLoaded(state, status) {
            state.isLoaded = status;
        },
        updateRecivablesSort(state, sortBy) {
            state.sortBy = sortBy;
        },
        updateRecivablesSortDirection(state, direction) {
            state.sortDirection = direction;
        },
    },
    actions: {
        addRecivable({ commit }, recivable) {
            return new Promise((resolve, reject) => {
                axios.post('/api/recivables', {recivable: recivable})
                    .then(response => {
                        recivable.id = response.data.id;
                        commit('addRecivable', recivable);
                        resolve(recivable);
                    }).catch(err => reject(err))
                ;
            });
        },
        updateRecivable({ commit }, recivable) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/recivables/${recivable.id}`, {recivable: recivable})
                    .then(() => {
                        commit('updateRecivable', recivable);
                        resolve(ecivable);
                    }).catch(err => reject(err))
                ;
            });
        },
        findRecivable({}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/recivables/${id}`)
                    .then(response => {
                        resolve(response.data.recivable);
                    }).catch(err => reject(err))
                ;
            });
        },
        getRecivables({ commit, getters }) {
            commit('updateRecivableLoaded', false);

            return new Promise((resolve, reject) => {
                const params = {
                    page: getters.recivablesPage,
                    perPage: getters.recivablesPerPage,
                    term: getters.recivableSearch,
                    orderBy: getters.recivablesSortBy,
                    sortDirection: getters.recivablesSortDirection,
                };

                axios.get(`/api/recivables`, { params: params })
                    .then(response => {
                        commit('setRecivable', response.data);
                        resolve(response.data.data);
                    }).catch(err => reject(err))
                ;
            });
        },
    },
    getters: {
        recivables: state => state.recivables,
        recivableSearch: state => state.search,
        isLoadedRecivables: state => state.isLoaded,
        recivablesPerPage: state => state.perPage,
        recivablesPage: state => state.page,
        recivablesTotal: state => state.total,
        recivablesSortBy: state => state.sortBy,
        recivablesSortDirection: state => state.sortDirection,
    }
}
