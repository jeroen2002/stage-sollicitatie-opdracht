import Vue from 'vue';
import Vuex from 'vuex'
import { BootstrapVue } from 'bootstrap-vue'
import { store } from './vue/store.js';


Vue.use(BootstrapVue);
Vue.component('home', require('./vue/pages/Home').default);

const app = new Vue({
    el: '#app',
    store: store
});
