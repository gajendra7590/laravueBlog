import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'; 
import VueToastr from 'vue-toastr';

Vue.use(VueToastr,{
  defaultPosition: 'toast-top-right',
  defaultType: 'info',
  defaultTimeout: 3000,
  closeOnHover: true,
  clickClose: true,
  defaultProgressBar :false,
  defaultClassNames:'zoomInUp'
}); 

axios.interceptors.response.use(function(response) {  
  return response;
},function(err) {   
    if( ( typeof(err.response)!=='undefined') ){    
        if( (typeof(err.response.status)!== 'undefined') && (err.response.status == 401) && err.response.data.message == 'Unauthenticated.' ){
          localStorage.removeItem('token');
          alert('Your session has been expired please login again..');
          window.location.href = '/login';
        }else if( (typeof(err.response.status)!== 'undefined') && (err.response.status == 403) && err.response.data.message == 'User does not have the right roles.' ){
         // alert('Your have no permission to access this section');
          //window.location.href = '/admin/home';

          console.log(VueToastr)
        }else{
          alert('something went wrong..')
        }  
    } 
});

const BASEURL =  window.location.origin; 
const APIprefix =  BASEURL+'/api/';

Vue.use(Vuex);
Vue.use(axios);

//all Seprate Events
import * as authActions from './authAction';
import * as blogsAction from './blogsAction'; 
import * as userAction from './usersAction'; 
import * as blogCategoryAction from './blogCategoryAction'; 
import * as frontAction from './frontAction'; 
const actions = Object.assign({}, 
  authActions.default, 
  blogsAction.default,
  blogCategoryAction.default,
  userAction.default,
  frontAction.default,
); 
export default new Vuex.Store({
    state: {
      baseURL : BASEURL,
      apiURL : APIprefix,
      isToken: !!localStorage.getItem('token'),
      getToken: localStorage.getItem('token'),
      userProfile : null,
    },
    mutations: {  
    },
    actions  
});
 



