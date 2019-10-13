const Vue = require('vue'); 
const Vuex = require('vuex');
const VueMoment = require('vue-moment');
import VueToastr from 'vue-toastr';

Vue.use(VueMoment);
Vue.use(VueToastr,{
    defaultPosition: 'toast-top-right',
    defaultType: 'info',
    defaultTimeout: 3000,
    closeOnHover: true,
    clickClose: true,
    defaultProgressBar :false,
    defaultClassNames:'zoomInUp'
}); 
 
import store from './store/index';
import router from './frontend/routes/router';
import UserFrontApp from './UserFrontApp';   
const app = new Vue({
    el: '#app',  
    render : h => h(        
        UserFrontApp
    ),
    store : store,
    router : router 
});

export default app; 

 


