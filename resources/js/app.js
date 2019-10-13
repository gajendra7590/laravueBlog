require('./bootstrap');   
const Vue = require('vue'); 
const Vuex = require('vuex'); 
import BootstrapVue from 'bootstrap-vue';
import { BModal, VBModal } from 'bootstrap-vue';
import VueToastr from 'vue-toastr';
import {ServerTable, ClientTable, Event} from 'vue-tables-2';

// app.js
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';


 
import store from './store/index';
import router from './admin/routes/router';
import AdminBackApp from './AdminBackApp.vue';  
import AdminFrontApp from './AdminFrontApp.vue'; 

Vue.use(BootstrapVue);
Vue.component('b-modal', BModal); 
Vue.directive('bv-modal', VBModal);

Vue.use(VueToastr,{
    defaultPosition: 'toast-top-right',
    defaultType: 'info',
    defaultTimeout: 3000,
    closeOnHover: true,
    clickClose: true,
    defaultProgressBar :false,
    defaultClassNames:'zoomInUp'
}); 
// Vue.use(ServerTable, [options = {}], [useVuex = false], [theme = 'bootstrap3'], [template = 'default']);
Vue.use(ClientTable, {}, false, 'bootstrap4');


const path = window.location.pathname;
var result = path.indexOf('/admin') > -1;
var npath = 0;
if(result){
    var npath = 1;
} 

// alert( window.location.pathname )

const app = new Vue({
    el: '#app',  
    render : h => h(        
        (npath == 1) ? AdminBackApp : AdminFrontApp
    ),
    store : store,
    router : router 
});

export default app; 

 


