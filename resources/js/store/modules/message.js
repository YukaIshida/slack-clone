const state = {
    channel_name: '',
    messages: [],
    placeholder: '',
    channel_id: '',
};

const getters = {
    channelName: state => {
        return state.channel_name;
    },
    messages: state => {
        return state.messages;
    },
    placeholder: state => {
        return state.placeholder;
    },
    channel_id: state => {
        return state.channel_id;
    },
};

const actions = {
    setMessagesAction({commit}, messages) {
        commit('setMessages', messages);  
    },
    setChannelNameAction({commit}, channelName) {
        commit('setChannelName', channelName);  
    },
    setPlaceholderAction({commit}, placeholder) {
        commit('setPlaceholder', placeholder);  
    },
    setChannelIdAction({commit}, channelId) {
        commit('setChannelId', channelId);  
    },
    fetchMessages({commit, state}) {
        axios.get('/api/messages?channel_id=' + state.channel_id)
        .then(response => {
            this.messages = response.data;
            commit('setMessages', response.data);
        })
        .catch(errors => {
            console.log('Unable to fetch messages');
        });    
    },
    sendMessage({commit, state, rootState}, message) {
        let submitArray = {};
        submitArray['channel_id'] = state.channel_id;
        submitArray['user'] = rootState.User.user.data.attributes.email;
        submitArray['content'] = message;
        
        axios.post('/api/messages', submitArray)
            .then(response => {
                commit('pushMessage', response.data);
            })
            .catch(errors => {
            });
    },
};

const mutations = {
    setMessages(state, messages) {
        state.messages = messages;
    },
    setChannelName(state, channelName) {
        state.channel_name = channelName;
    },
    setPlaceholder(state, placeholder) {
        state.placeholder = placeholder;
    },
    setChannelId(state, channelId) {
        state.channel_id = channelId;
    },
    pushMessage(state, message) {
        state.messages.data.push(message);
    },
};

export default {
    state, getters, actions, mutations,
}