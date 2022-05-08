require('./bootstrap');

window.Vue = require('vue').default;

import moment from 'moment';
import Swal from 'sweetalert2'
import Timer from "easytimer.js";
const timer = new Timer();
const pauseTimer = new Timer();


global.timer = timer
global.pauseTimer = pauseTimer
global.Swal = Swal
global.moment = moment

Vue.component('counter-component', require('./components/CounterComponent.vue').default);

const app = new Vue({
    el: '#app',
});
