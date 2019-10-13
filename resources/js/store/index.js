import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'; 

axios.interceptors.response.use(function(response) {  
  return response;
},function(err) {   
    if( ( typeof(err.response)!=='undefined') ){   
        if( (typeof(err.response.status)!== 'undefined') && (err.response.status == 401) && err.response.data.message == 'Unauthenticated.' ){
          localStorage.removeItem('token');
          alert('Your session has been expired please login..');
          window.location.href = '/login';
        }else{
          alert('else case')
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
      userProfile : null
    },
    mutations: {  
    },
    actions  
});
 



