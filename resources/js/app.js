require('./bootstrap');

window.Vue = require('vue');

//Import Vue Filter
require('./filter');

//Import progressbar
require('./progressbar');

//Setup custom events 
require('./customEvents');

//Import View Router
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Import axios
import Axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, Axios);

//Axios.defaults.baseURL = 'http://localhost:8000/api';

//Pagination laravel-vue-pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//ChartJs component
Vue.component('chart-component', require('./components/ChartComponent.vue').default);

//Import Sweetalert2
import Swal from 'sweetalert2'

//import Line from 'vue-chartJS'

window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast

//Import v-from
import {Form, HasError, AlertError} from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Routes
import {routes} from './routes';

//Register Routes
const router = new VueRouter({
    routes,
    mode: 'hash',

})

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});