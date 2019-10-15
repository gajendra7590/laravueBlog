<template> 
   <div class="resend verification code">
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
                    <h1 class="h4 text-gray-900 mb-4">Resend verification code</h1>
                  </div>
                  <form class="user" v-on:submit.prevent="verifyFormSubmit">
                    <div class="form-group">
                      <input type="text" v-model="reVerifyForm.email" autocomplete="off" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Your email address">
                      <span class = "help-block">* Enter your registered email address with us.</span>
                      <p for="" v-if="errorsArr.email" class="text-danger">{{ errorsArr.email }}</p>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block" :disabled="submitDisabled">
                      Generate your code
                    </button>  
                  </form>
                  <hr>
                  <div class="text-center">
                    <!-- <router-link class="small" to="/resendVerifyCode">If you do not get verification code?</router-link> -->
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
        name : "resend-verification-code",
        data : function(){
          return {
            reVerifyForm : {
              email :""
            },
            errorsArr:[],
            submitDisabled : false
          }
        },
        methods:{ 
            verifyFormSubmit(){ 
                let _this = this; 
                 _this.submitDisabled = true;
                _this.$store.dispatch('verifyResendCode',{email:_this.reVerifyForm.email})
                  .then(function(data){   
                    if( typeof data.status !='undefined' && (data.status == true)){ 
                       _this.submitDisabled = false;
                      _this.$toastr.s('New verification code sended on your email please check','Success');
                      var url = '/verify-account/'+data.result.data.identifier; 
                     setTimeout(function () { 
                         window.location.href = url;
                      },2000);
                    }else if( typeof data.status !='undefined' && (data.status == false)){
                      _this.submitDisabled = false;
                      _this.errorsArr = data.result.errors; 
                    } 
                }); 

            }
                  
        },
        created(){ 
           //this.veryfyAccount();
        },
        watch: { 
          //'$route': 'veryfyAccount'
        }
           
    }
</script>
<style scoped>
 span.help-block {
    font-size: 11px;
    margin-left: 20px;
} 
.bg-login-image {
    background: url(/images/login.jpg) !important;
    background-position: center !important;
    background-size: cover !important;
}  
</style>