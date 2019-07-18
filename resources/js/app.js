
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./vendor/bs4-toast/js/toast-alert.js');
require('malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js');
require('bootstrap-fileinput/js/plugins/sortable.min.js');
require('bootstrap-fileinput/js/plugins/piexif.min.js');
require('bootstrap-fileinput/js/fileinput.min.js');
require('./vendor/bootstrap-fileinput/themes/fe/theme.js');
require('bootstrap-fileinput/js/locales/pt-BR.js');
//require('./vendor/bootstrap-fileinput/defaults.js');
require('./admix');

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//import Router from 'vue-router';

//Vue.use(Router);

// const app = new Vue({
//     el: '#app',
//     data: {
//         title: 'Hello World!'
//     }
// });
