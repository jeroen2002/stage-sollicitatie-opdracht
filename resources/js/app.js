import Vue from 'vue';
import 'noty/lib/noty';
import { BootstrapVue } from 'bootstrap-vue';
import { store } from './vue/store.js';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrashAlt, faInfoCircle, faEdit } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTrashAlt)
library.add(faInfoCircle);
library.add(faEdit)

Vue.use(BootstrapVue);
Vue.component('home', require('./vue/pages/Home').default);
Vue.component('font-awesome-icon', FontAwesomeIcon)

new Vue({
    el: '#app',
    store: store
});
