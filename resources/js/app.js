require('./bootstrap');
import Vue from 'vue';
import router from './router';
import Toast from "vue-toastification";
import VueRouter from 'vue-router'
import "vue-toastification/dist/index.css";
import { Form, HasError, AlertError, AlertSuccess } from 'vform';
import VueProgressBar from 'vue-progressbar'
import VueNotification from "@kugatsu/vuenotification";
import moment from 'moment';

window.Vue = require('vue');
//router
Vue.use(VueRouter);

window.Vue = require('vue');

const options = {
    // You can set your default options here
    timeout: 3500,
    draggable: true,
    closeOnClick: false,
};
Vue.use(Toast, options);
//vForm
window.Form = Form;
//vForm
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
// ES6 Modules or TypeScript
window.Swal = require('sweetalert2');
//custum event
window.Fire = new Vue();
//progress bar
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px'
});
//notification
Vue.use(VueNotification, {
    timer: 10,
    position: "topRight",
    //title: "Vue notification",
    error: {
        background: "#F56565",
        color: "white"
    },
    success: {
        background: "#38A169",
        color: "white"
    },
    warning: {
        background: "#ED8936",
        color: "white"
    }
});

import 'fullcalendar/dist/fullcalendar.css'
import FullCalendar from 'vue-full-calendar'
Vue.use(FullCalendar)



Vue.filter('uppercase', function (text) {
    return text.toUpperCase();
});

Vue.filter('date', function name(created) {
    return moment(created).format('MMMM DD YYYY');
});
Vue.component('pagination', require('laravel-vue-pagination'));
// const files =  require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: '',
    },
    methods: {
        searchit() {
            Fire.$emit('searching');
        }
    }

});
