import Vue from 'vue';
import VueRouter from 'vue-router';
import Message from "./views/Message";
import ChannelSearch from "./views/ChannelSearch";

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {path:"/home", component: Message},
    {path:"/channel-search", component: ChannelSearch},
  ],
  mode: 'history'
}); 