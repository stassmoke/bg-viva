import axios from 'axios';

export default {
    state: {
        search: null,

        calls: [
            
        ],
    },
    mutations: {
        addCalls(state, call) {
            state.calls.unshift(call);
        },

        updateClientSearch(state, search) {
          state.search = search;
        },
    },
    actions: {

        addCalls({ commit }, payload) {
            commit('addCalls', payload);
        },
    },
    getters: {
        calls: state => state.calls,

        callSearch: state => state.search,
    }
}