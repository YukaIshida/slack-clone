import Vue from 'vue';
import VueRouter from 'vue-router';
import Message from "./views/Message";

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {path:"/home", component: Message}
  ],
  mode: 'history'
}); 