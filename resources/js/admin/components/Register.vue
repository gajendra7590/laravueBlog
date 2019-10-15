<template>
    <div id="registerc">  
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
                    <h1 class="h4 text-gray-900 mb-4">Create Your Account</h1>
                  </div>
                  <form class="user" v-on:submit.prevent="registerSubmit">
                    <div class="form-group">
                      <input type="text" v-model="loginForm.name" autocomplete="off" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter User Name...">
                      <p for="" v-if="errorsArr.name" class="text-danger">{{ errorsArr.name }}</p>
                    </div>
                    <div class="form-group">
                      <input type="email" v-model="loginForm.email" autocomplete="off" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      <p for="" v-if="errorsArr.email" class="text-danger">{{ errorsArr.email }}</p>
                    </div>
                    <div class="form-group">
                      <input type="password" v-model="loginForm.password" autocomplete="off" class="form-control form-control-user" placeholder="Password">
                      <p for="" v-if="errorsArr.password" class="text-danger">{{ errorsArr.password }}</p>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block" :disabled="submitDisabled">
                      Create Account
                    </button>  
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link class="small" to="/login">I have an already account?</router-link>
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
        name : "registerc",
        data:function(){
          return {
            loginForm : {
               name : '',
               email : '',
               password : ''
            },
            errorsArr:[],
            submitDisabled : false
          }
        },
        methods:{ 
          registerSubmit(){ 
             let _this = this;
             _this.submitDisabled = true;
             this.$store.dispatch('register',this.loginForm) 
             .then(function(data){
                   if( typeof(data.status)!='undefined' && data.status == true){ 
                     _this.$toastr.s('Your Account Created Successfully','Success');  
                     var url = '/verify-account/'+data.result.data.identifier; 
                      _this.submitDisabled = false;
                     setTimeout(function () { 
                         window.location.href = url;
                      },2000);
                    // _this.$router.push(url);
                   }else if( typeof(data.status)!='undefined' && data.status == false){ 
                      _this.errorsArr = data.result.errors;
                      _this.submitDisabled = false;
                   }else{
                      _this.$toastr.e('Something went wrong','Invalid');
                       _this.submitDisabled = false;
                  }
             });
          } 
        } 
    }
</script>
<style scoped>
    .bg-login-image {
        background: url(/images/register.jpg) !important;
        background-position: center !important;
        background-size: cover !important;
    }
   
</style>