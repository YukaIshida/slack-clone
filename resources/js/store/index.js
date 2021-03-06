
import Vue from 'vue';
import Vuex from 'vuex';
import User from './modules/user';
import Message from './modules/message';
import Modal from './modules/modal';
import DmChannel from './modules/dmChannel';
import JoiningChannel from './modules/joiningChannel';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        User,
        Modal,
        Message,
        DmChannel,
        JoiningChannel
    }
});