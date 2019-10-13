export default { 
    usersList(context,payload = null){   
        let _this = this;
        return new Promise(function(resolve, reject) {  
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.get(context.state.apiURL+'users',payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {  
                return reject(error.response);
            });  
        });      
    },
    editUser(context,id){
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.get(context.state.apiURL+'users/'+id+'/edit', {})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    saveUser(context,payload){
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post(context.state.apiURL+'users', payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    updateUser(context,payload){ 
        // console.log(payload);return false;
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post(context.state.apiURL+'users/update', payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    deleteUser(context,id){ 
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.delete(context.state.apiURL+'users/'+id, {})
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    },
    changeStatusUser(context,payload){
        return new Promise(function(resolve, reject) { 
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
            axios.post(context.state.apiURL+'users/changeStatus', payload)
            .then(function (response) {  
                return resolve(response.data)
            })
            .catch(function (error) {
                return reject(error.response);
            });  
        }); 
    }      
} 




