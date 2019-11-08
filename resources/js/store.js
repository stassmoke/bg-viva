import Vue from 'vue'
import Vuex from 'vuex'

import userModule from './store/user'
import clientsModule from './store/clients';
import callsModule from './store/calls';
import meetingsModule from './store/meetings';


import commonModule from './store/common'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        commonModule,
        userModule,
        clientsModule,
        callsModule,
        meetingsModule

    }
}) 
