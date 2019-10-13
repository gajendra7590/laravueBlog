<template>
    <div id="logoutc"> 
        <h2>Logout Page.</h2>
    </div>
</template>
<script>
    export default {
        name : "logoutc" ,
        data:function(){
            return{

            }
        },
        methods:{
            userLogOut(){
                let _this = this;  
                this.$store.dispatch('userLogout')
                .then(function(data){  
                    if(typeof(data.status)!='undefined' && data.status == true){
                    _this.$toastr.s(data.message,'SUCCESS!');  
                     localStorage.removeItem('token');
                     window.location.href = '/login'
                    }else if(typeof(data.status)!='undefined' && data.status == false){
                        if(data.result.errors != null || data.result.errors != ''){ 
                            _this.$toastr.e(data.message,'Warning!'); 
                        } 
                    }else{

                    }
                }).catch(function(e){
                    localStorage.removeItem('token');
                    window.location.href = '/login';
                }); 
            }
        },
        created(){
            this.userLogOut();
        }
    }
</script>