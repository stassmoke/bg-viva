export default {
    state: {
        processing: false,
        error: null,
        isShowNav: true,
    },
    mutations: {
        set_processing(state, payload) {
            state.processing = payload
        },
        set_error(state, payload) {
            state.error = payload
        },
        clean_error(state) {
            state.error = null
        },
        toggleNav(state) {
            state.isShowNav = !state.isShowNav;
        },
        closeNav(state) {
            state.isShowNav = false;
        }
    },
    getters: {
        getProcessing: (state) => state.processing,
        getError: (state) => state.error,
        isShowNav: state => state.isShowNav,
    }
}
