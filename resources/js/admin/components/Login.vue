<template>
    <div id="loginc">  
    <div class="row justify-content-center">  
      <div class="col-xl-10 col-lg-12 col-md-9"> 
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Your Account</h1>
                  </div>
                  <form class="user" v-on:submit.prevent="loginSubmit">
                    <div class="form-group">
                      <input type="email" v-model="loginForm.email" autocomplete="off" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" v-model="loginForm.password" autocomplete="off" class="form-control form-control-user" placeholder="Password">
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>  
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link class="small" to="/register">Create new account?</router-link>
                  </div>
                  <!-- <div class="text-center">
                    <router-link class="small" to="/forgot-password">Forgot Password?</router-link>
                  </div>  -->
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div> 
    </div>
    </div>
</template>
<script>
    export default {
        name : "loginc",
        data:function(){
          return {
            loginForm : {
               email : '',
               password : ''
            }

          }
        },
        methods:{ 
          loginSubmit(){ 
             let _this = this;
             this.$store.dispatch('login',this.loginForm) 
             .then(function(data){
                   if( typeof(data.status)!='undefined' && data.status == true){ 
                     _this.$toastr.s(data.message,'Login alert')
                     localStorage.setItem('token',data.result.token.access_token); 
                     window.location.href='/admin/home';                    
                   }else if( typeof(data.status)!='undefined' && data.status == false){
                      _this.$toastr.e(data.message,'Login alert') 
                   }else{
                      _this.$toastr.e('Something went wrong','Invalid')
                  }
             });
          } 
        } 
    }
</script>
<style scoped>
    .bg-login-image {
        background: url(/images/login.jpg) !important;
        background-position: center !important;
        background-size: cover !important;
    }
   
</style>