import Vue from 'vue'; 
import axios from 'axios'; 
Vue.use(axios);

export default { 
    blogCategories(context,payload = null){   
        return new Promise(function(resolve, reject) {  
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.get(context.state.apiURL+'categories',payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        });      
    },
    categoriesList(context,payload = null){   
        let _this = this;
        return new Promise(function(resolve, reject) {  
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.get(context.state.apiURL+'categories',payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {  
                return reject(error.response);
            });  
        });      
    },
    editCategories(context,id){
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.get(context.state.apiURL+'categories/'+id+'/edit', {})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    saveCategories(context,payload){
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post(context.state.apiURL+'categories', payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    updateCategories(context,payload){ 
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post(context.state.apiURL+'categories/update', payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    deleteCategories(context,id){ 
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.delete(context.state.apiURL+'categories/'+id, {})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    } 
} 




