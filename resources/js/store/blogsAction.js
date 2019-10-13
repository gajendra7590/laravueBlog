export default { 
        blogsList(context,payload = null){   
            return new Promise(function(resolve, reject) {  
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
                axios.get(context.state.apiURL+'blogs',payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            });      
        },
        editBlog(context,id){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
                axios.get(context.state.apiURL+'blogs/'+id+'/edit', {})
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        saveBlog(context,payload){
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
                axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                axios.post(context.state.apiURL+'blogs', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        updateBlog(context,payload){ 
            // console.log(payload);return false;
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
                axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                axios.post(context.state.apiURL+'blogs/update', payload)
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        },
        deleteBlog(context,id){ 
            return new Promise(function(resolve, reject) { 
                axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`; 
                axios.delete(context.state.apiURL+'blogs/'+id, {})
                .then(function (response) {  
                    return resolve(response.data)
                })
                .catch(function (error) {
                    return reject(error.response);
                });  
            }); 
        }      
} 
 



