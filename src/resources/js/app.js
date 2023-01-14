import Vue from "vue/dist/vue.js";
import VueRouter from 'vue-router';
import routes from './routes';
import '../css/app.css';

Vue.use(VueRouter);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});