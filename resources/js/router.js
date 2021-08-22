import Vue from 'vue';
import VueRouter from 'vue-router';
import Message from "./views/Message";
import ChannelSearch from "./views/ChannelSearch";
import DmSearch from "./views/DmSearch";

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {path:"/home", component: Message},
    {path:"/channel-search", component: ChannelSearch},
    {path:"/dm-search", component: DmSearch},
  ],
  mode: 'history'
}); 