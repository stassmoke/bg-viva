import Vue from 'vue'
import Vuex from 'vuex'

import userModule from './store/user'
import commonModule from './store/common'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        commonModule,
        userModule,
    }
}) 
