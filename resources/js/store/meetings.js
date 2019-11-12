import axios from 'axios';

export default {
    state: {
        search: null,
        isLoaded: false,
        perPage: 20,
        page: 1,
        total: 0,
        sortBy: 'id',
        sortDirection: 'DESC',
        meetings: [],
    },
    mutations: {
        addMeeting(state, meeting) {
            state.meetings.unshift(meeting);
        },
        updateMeeting(state, meeting) {
            const indexOfCall = state.meetings.findIndex(foundMeeting => foundMeeting.id === meeting.id);

            if (indexOfCall === -1) {
                return;
            }

            state.meetings[indexOfCall] = meeting;
        },
        updateMeetingsSearch(state, search) {
            state.search = search;
        },
        setMettings(state, pagination) {
            state.meetings = pagination.data;
            state.total = pagination.total;
            state.isLoaded = true;
        },
        updateMeetingsPerPage(state, perPage) {
            state.perPage = perPage;
        },
        updateMeetingsPage(state, page) {
            state.page = page;
        },
        updateCallLoaded(state, status) {
            state.isLoaded = status;
        },
        updateMeetingsSort(state, sortBy) {
            state.sortBy = sortBy;
        },
        updateMeetingsSortDirection(state, direction) {
            state.sortDirection = direction;
        },
    },
    actions: {
        addCall({ commit }, meeting) {
            return new Promise((resolve, reject) => {
                axios.post('/api/meetings', {meeting: meeting})
                    .then(response => {
                        call.id = response.data.id;
                        commit('addMeeting', meeting);
                        resolve(meeting);
                    }).catch(err => reject(err))
                ;
            });
        },
        updateCall({ commit }, meeting) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/meetings/${meeting.id}`, {meeting: meeting})
                    .then(() => {
                        commit('updateMeeting', meeting);
                        resolve(meeting);
                    }).catch(err => reject(err))
                ;
            });
        },
        findCall({}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/calls/${id}`)
                    .then(response => {
                        resolve(response.data.meeting);
                    }).catch(err => reject(err))
                ;
            });
        },
        getCalls({ commit, getters }) {
            commit('updateCallLoaded', false);

            return new Promise((resolve, reject) => {
                const params = {
                    page: getters.meetingsPage,
                    perPage: getters.meetingsPerPage,
                    term: getters.meetingsSearch,
                    orderBy: getters.meetingsSortBy,
                    sortDirection: getters.meetingsSortDirection,
                };

                axios.get(`/api/meetings`, { params: params })
                    .then(response => {
                        commit('setMeetings', response.data);
                        resolve(response.data.data);
                    }).catch(err => reject(err))
                ;
            });
        },
    },
    getters: {
        meetings: state => state.meetings,
        meetingsSearch: state => state.search,
        isLoadedMeetings: state => state.isLoaded,
        meetingsPerPage: state => state.perPage,
        meetingsPage: state => state.page,
        meetingsTotal: state => state.total,
        meetingsSortBy: state => state.sortBy,
        meetingsSortDirection: state => state.sortDirection,
    }
}
