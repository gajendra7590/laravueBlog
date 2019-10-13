import Vue from 'vue';
import axios from 'axios';
Vue.use(axios);

export default { 
    catList(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'catList',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    top4BlogSideBar(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'top4Blog',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    top2FootLeft(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'top2FootLeft',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    top2FootRight(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'top2FootRight',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    homeRecentBlogs(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'homeRecentBlogs',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    homeTopBlogs(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'homeTopBlogs',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    singleBlog(context,blogTitle){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'singleBlog/'+blogTitle,{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    blogsByCategory(context,catUrl){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'blogsByCategory/'+catUrl,{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    }                                                     
} 




