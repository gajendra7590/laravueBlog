<template>
    <div id="fpassc"> 
        <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center" v-bind:class="emailFormClass">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a one time password to reset your password!</p>
                  </div>

                  <div class="text-center" v-bind:class="emailCodeFormClass">
                    <h1 class="h4 text-gray-900 mb-2">Verify your account</h1>
                    <p class="mb-4">We have sent one time password to verify your account please check</p>
                  </div>

                  <form v-if="accountSwitch" class="user" v-bind:class="emailFormClass" v-on:submit.prevent="fPassFormSubmit">
                    <div class="form-group">
                      <input type="text" v-model="forgotForm.email" class="form-control form-control-user" placeholder="Enter Email Address...">
                      <p for="" v-if="errorsArr.email" class="text-danger">{{ errorsArr.email }}</p>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block" :disabled="submitDisabled">
                      Send One Time Password
                    </button>
                  </form>  

                  <form v-if="!accountSwitch" class="user d-none" v-bind:class="emailCodeFormClass" v-on:submit.prevent="fPassFormCodeSubmit" > 
                     <div class="form-group">
                      <input type="password" v-model="forgotForm.password" class="form-control form-control-user" placeholder="Enter your new password">
                      <p for="" v-if="errorsArr.password" class="text-danger">{{ errorsArr.password }}</p>
                    </div>
                     <div class="form-group">
                      <input type="text" v-model="forgotForm.code" class="form-control form-control-user" placeholder="Enter code">
                      <p for="" v-if="errorsArr.code" class="text-danger">{{ errorsArr.code }}</p>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" :disabled="submitDisabled">
                      Verify your code
                    </button>
                    <hr />
                    <div class="text-center">
                      <a href="javascript:viod(0);" class="small" @click.prevent="switchEmail">Resend code/Change you email ?</a>
                    </div>
                  </form>
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
        name : "fpassc",
        data : function(){
          return {
            forgotForm : {
              email :"",
              code : "",
              password:""
            }, 
            emailFormClass:'d-block',
            emailCodeFormClass:'d-none',
            errorsArr:[],
            accountSwitch : true,
            submitDisabled : false
          }
        },
        methods:{ 
            fPassFormSubmit(){    
                let _this = this; 
                _this.errorsArr = [];
                _this.submitDisabled = true;
                _this.$store.dispatch('forgotPasswordCodeSend',{email:_this.forgotForm.email})
                  .then(function(data){   
                    if( typeof data.status !='undefined' && (data.status == true)){ 
                      _this.emailCodeFormClasses();   
                      _this.submitDisabled = false;                    
                      _this.$toastr.s('We have successfully sent one time password on your email','Success');
                    }else if( typeof data.status !='undefined' && (data.status == false)){
                      _this.errorsArr = data.result.errors; 
                      _this.submitDisabled = false;  
                    } 
                });  
            },
            fPassFormCodeSubmit(){
                 let _this = this; 
                _this.errorsArr = [];
                _this.submitDisabled = true;  
                _this.$store.dispatch('forgotPasswordCodeVerify',this.forgotForm)
                  .then(function(data){   
                    if( typeof data.status !='undefined' && (data.status == true)){  
                      _this.$toastr.s('Your password has been changed successfully','Success');
                      _this.$router.push({path :'/login'});
                      _this.submitDisabled = false;  
                    }else if( typeof data.status !='undefined' && (data.status == false)){
                      _this.errorsArr = data.result.errors; 
                      _this.submitDisabled = false;  
                    } 
                }); 
            },
            switchEmail(){
              this.emailFormClasses();
              this.forgotForm.code="";
              this.forgotForm.password=""; 
              
            },
            emailFormClasses(){
              this.emailFormClass = 'd-block';
              this.emailCodeFormClass = 'd-none';
              this.accountSwitch = true;
            },
            emailCodeFormClasses(){
              this.emailFormClass = 'd-none';
              this.emailCodeFormClass = 'd-block';   
              this.accountSwitch = false;           
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
<style>
    .bg-login-image {
        background: url(/images/default/login.jpg) !important;
        background-position: center !important;
        background-size: cover !important;
    }
</style>