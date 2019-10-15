import Vue from 'vue';
import axios from 'axios';
Vue.use(axios);

export default { 
    contactDetail(context){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'contactDetail',{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    contactDetailSave(context,formData = []){   
        return new Promise(function(resolve, reject) {  
            axios.post(context.state.apiURL+'contactDetailSave',formData)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
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
    homeRecentBlogs(context,payload){  
        return new Promise(function(resolve, reject) {  
            axios.post(context.state.apiURL+'homeRecentBlogs',payload)
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
    singleBlogSimilarPost(context,blogTitle){   
        return new Promise(function(resolve, reject) {  
            axios.get(context.state.apiURL+'singleSimilarPost/'+blogTitle,{})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    blogsByCategory(context,payload){    
        return new Promise(function(resolve, reject) {  
            axios.post(context.state.apiURL+'blogsByCategory/'+payload.catName,payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    blogsByFilter(context,payload){    
        return new Promise(function(resolve, reject) {  
            axios.post(context.state.apiURL+'blogsByFilter',payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    }                                                         
} 




