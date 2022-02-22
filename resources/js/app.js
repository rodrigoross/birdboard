/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./switchTheme');

import Alpine from 'alpinejs';
import VModal from 'vue-js-modal'

window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(VModal);

window.Alpine = Alpine;

Alpine.start();
const app = new Vue({
    el: '#app',
});
