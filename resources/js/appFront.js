const Vue = require('vue'); 
const Vuex = require('vuex');
const VueMoment = require('vue-moment');
import VueToastr from 'vue-toastr';
import VueFilter from 'vue-filter';
import Paginate from 'vuejs-paginate';
import VueLazyload from 'vue-lazyload';  

Vue.use(VueMoment);
Vue.use(VueFilter);
Vue.component('paginate', Paginate);
Vue.use(VueToastr,{
    defaultPosition: 'toast-top-right',
    defaultType: 'info',
    defaultTimeout: 3000,
    closeOnHover: true,
    clickClose: true,
    defaultProgressBar :false,
    defaultClassNames:'zoomInUp'
}); 

Vue.use(VueLazyload,{
    preLoad: 1.3,
    error: '/images/default/lazy_img.jpg',
    loading: '/images/default/lazy_img.jpg', 
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

 


