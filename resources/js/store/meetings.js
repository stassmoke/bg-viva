import axios from 'axios';

export default {
    state: {
        search: null,

        meetings: [
            
        ],

    },
    mutations: {
        addMeeting(state, meeting) {
            state.meetings.unshift(meeting);
        },

        updateMeetingSearch(state, search) {
          state.search = search;
        },
    },
    actions: {
        addMeeting({ commit }, payload) {
            commit('addMeeting', payload);
        },

    },
    getters: {
        meetings: state => state.meetings,

        meetingSearch: state => state.search,
    }
}