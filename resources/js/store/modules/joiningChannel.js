const state = {
    joiningChannels: [],
};

const getters = {
    joiningChannels: state => {
        return state.joiningChannels;
    },
};

const actions = {
    fetchJoiningChannels({commit, rootState}) {
        axios.get('/api/channels?user_id=' + rootState.User.user.data.user_id)
        .then(response => {
            commit('setJoiningChannels', response.data.data);
        })
        .catch(errors => {
            console.log('Unable to fetch joining Channels.');
        });
    },
    pushChannelAction({commit}, channel) {
        commit('pushChannel', channel);  
    },
};

const mutations = {
    setJoiningChannels(state, channels) {
        state.joiningChannels = channels;
    },
    pushChannel(state, channel) {
        state.joiningChannels.data.push(channel);
    },
};

export default {
    state, getters, actions, mutations,
}