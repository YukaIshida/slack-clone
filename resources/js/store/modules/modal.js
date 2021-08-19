const state = {
    addChannelModal: false,
    sideModal: false,
};

const getters = {
    addChannelModal: state => {
        return state.addChannelModal;
    },
    sideModal: state => {
        return state.sideModal;
    },
};

const actions = {
    updateChannelModalAction({commit}, addChannelModal) {
        commit('updateChannelModal', addChannelModal);
    },
    updateSideModalAction({commit}, sideModal) {
        commit('updateSideModal', sideModal);
    },
};

const mutations = {
    updateChannelModal(state, addChannelModal) {
        state.addChannelModal = addChannelModal;
    },
    updateSideModal(state, sideModal) {
        state.sideModal = sideModal;
    },
};

export default {
    state, getters, actions, mutations,
}