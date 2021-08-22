const state = {
    dmUsers: [],
};

const getters = {
    dmUsers: state => {
        return state.dmUsers;
    },
};

const actions = {
    fetchDmUsers({commit}) {
        axios.get('/api/dm-channels')
        .then(response => {
            commit('setDmUsers', response.data);
        })
        .catch(errors => {
            console.log('Unable to fetch dmUsers.');
        });
    },
    pushDmUserAction({commit}, user) {
        commit('pushDmUser', user);  
    },
};

const mutations = {
    setDmUsers(state, users) {
        state.dmUsers = users;
    },
    pushDmUser(state, user) {
        state.dmUsers.data.push(user);
    },
};

export default {
    state, getters, actions, mutations,
}