import Vue from 'vue'; 
import axios from 'axios'; 
Vue.use(axios);

export default { 
        login(context,payload){ 
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'login', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            });      
        },
        register(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'register', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        verifyAccount(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'verifyAccount', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        verifySubmitAccount(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'verifySubmitAccount', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        verifyResendCode(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'verifyResendCode', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        forgotPasswordCodeSend(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'forgotPasswordCodeSend', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        forgotPasswordCodeVerify(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.post(context.state.apiURL+'forgotPasswordCodeVerify', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        userProfile(context){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;  
                axios.get(context.state.apiURL+'user/profile', {})
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        updateProfile(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;  
                axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                axios.post(context.state.apiURL+'user/profileUpdate', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        userLogout(context){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;  
                axios.post(context.state.apiURL+'logout', {})
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        userDashboard(context){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;  
                axios.get(context.state.apiURL+'dashboard')
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        }      
} 
 



