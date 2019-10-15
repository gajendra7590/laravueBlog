<template> 
   <div class="verify Account">
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
                    <h1 class="h4 text-gray-900 mb-4">Verify Your Account</h1>
                  </div>
                  <form class="user" v-on:submit.prevent="verifysubmit">
                    <div class="form-group">
                      <input type="text" v-model="verifyForm.code" autocomplete="off" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Verification code..">
                      <span class = "help-block">* You would recieved verification code on your email.</span>
                      <p for="" v-if="errorsArr.code" class="text-danger">{{ errorsArr.code }}</p>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Submit to verify
                    </button>  
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link class="small" to="/resendVerifyCode">If you do not get verification code?</router-link>
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
        name : "verify-account",
        data : function(){
          return {
            verifyForm : {
              code :""
            },
            errorsArr:[]
          }
        },
        methods:{
            veryfyAccount(){
              var identifier = this.$route.params.getVcode; 
              let _this = this; 
              _this.$store.dispatch('verifyAccount',{identifier})
                .then(function(data){   
                  if( typeof data.status !='undefined' && (data.status == true)){ 
                  }else if( typeof data.status !='undefined' && (data.status == false)){
                    _this.$toastr.e('Invalid Authorisation','Warnign');
                     setTimeout(function () { 
                         window.location.href = '/login';
                     },500);
                  }else{
                    _this.$toastr.e('Invalid Authorisation','Warnign');
                     setTimeout(function () { 
                         window.location.href = '/login';
                     },500);
                  } 
              });  
            },
            verifysubmit(){
                var identifier = this.$route.params.getVcode; 
                let _this = this; 
                _this.$store.dispatch('verifySubmitAccount',{identifier:identifier,code:_this.verifyForm.code})
                  .then(function(data){  
                    if( typeof data.status !='undefined' && (data.status == true)){ 
                       _this.$toastr.s('Your account has bee activated','Success');
                      setTimeout(function () { 
                          window.location.href = '/login';
                      },500);
                    }else if( typeof data.status !='undefined' && (data.status == false)){
                      _this.errorsArr = data.result.errors; 
                    }else{
                      _this.$toastr.e('Invalid Authorization','Error');
                      setTimeout(function () { 
                          window.location.href = '/login';
                      },500);
                    } 
                }); 
            }
                  
        },
        created(){ 
           this.veryfyAccount();
        },
        watch: { 
          '$route': 'veryfyAccount'
        }
           
    }
</script>
<style>
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