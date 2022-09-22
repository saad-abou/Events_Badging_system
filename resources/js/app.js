/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import VueMobileDetection from 'vue-mobile-detection';
import router from "./router"

window.Vue.use(Vuetify);
Vue.use(VueMobileDetection)

import BootstrapVue from 'bootstrap-vue' //Importing

Vue.use(BootstrapVue) // Telling Vue to use this in whole application





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home', require('./components/home.vue').default);
Vue.component('newcomptes', require('./components/newComptes.vue').default);
Vue.component('stats', require('./components/stats.vue').default);
Vue.component('userspreinscrit', require('./components/usersPreinscrit.vue').default);
Vue.component('newcompteform', require('./components/newCompteForm.vue').default);
Vue.component('stream', require('./components/streamCode.vue').default);
Vue.component('certificat', require('./components/certificat.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi',
        },
    }),
});
