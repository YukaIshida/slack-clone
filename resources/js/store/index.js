
import Vue from 'vue';
import Vuex from 'vuex';
import User from './modules/user';
import Modal from './modules/modal';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        User,
        Modal
    }
});