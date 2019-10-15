<template>
    <div id="contactus">  
        <section class="ptb-0">
            <div class="mb-30 brdr-ash-1 opacty-5"></div>
            <div class="container">
                <router-link class="mt-10" :to="`/`"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></router-link>
                <a class="color-ash mt-10" href="javascript:void(0);">Contact us</a>
            </div><!-- container -->
        </section>
        <section>
            <div class="container">
                <div class="row">
                
                    <div class="col-sm-12 col-md-8">
                        <h3><b>SEND US A MESSAGE</b></h3>
                        <p class="mb-30 mr-100 mr-sm-0">We’d love to hear from you – please get in touch for comments, requests, 
                            advertising partnerships or job inquiries.</p>
                        <form @submit.prevent="contactFormSubmit()" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
                            <div class="row"> 
                                <div class="col-sm-12">
                                    <p class="color-ash">Contact Subject*</p>
                                    <div class="pos-relative">
                                        <input class="pr-20" v-model="contactForm.contact_subject" type="text" value="">
                                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                    </div><!-- pos-relative -->
                                    <p for="" v-if="errorsArr.contact_subject" class="text-danger">{{ errorsArr.contact_subject }}</p>
                                </div><!-- col-sm-6 -->

                                <div class="col-sm-6">
                                    <p class="color-ash">Your Full Name*</p>
                                    <div class="pos-relative">
                                        <input class="pr-20" v-model="contactForm.contact_fullname" type="text" value="">
                                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                    </div><!-- pos-relative -->
                                    <p for="" v-if="errorsArr.contact_fullname" class="text-danger">{{ errorsArr.contact_fullname }}</p>
                                </div><!-- col-sm-6 -->
                                
                                <div class="col-sm-6">							
                                    <p class="color-ash">Email*</p>
                                    <div class="pos-relative">
                                        <input class="pr-20" v-model="contactForm.contact_email" type="text">
                                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                    </div><!-- pos-relative -->
                                    <p for="" v-if="errorsArr.contact_email" class="text-danger">{{ errorsArr.contact_email }}</p>
                                </div><!-- col-sm-6 -->
                                
                                <div class="col-sm-6">	
                                    <p class="color-ash">Your Phone*</p>
                                    <div class="pos-relative">
                                        <input class="pr-20" v-model="contactForm.contact_phone" type="text">
                                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                    </div><!-- pos-relative -->
                                    <p for="" v-if="errorsArr.contact_phone" class="text-danger">{{ errorsArr.contact_phone }}</p>
                                </div><!-- col-sm-6 -->
                                
                                <div class="col-sm-6">	
                                    <p class="color-ash">Company*</p>
                                    <div class="pos-relative">
                                        <input class="pr-20" v-model="contactForm.contact_message" type="text">
                                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                                    </div><!-- pos-relative -->
                                    <p for="" v-if="errorsArr.contact_message" class="text-danger">{{ errorsArr.contact_message }}</p>
                                </div><!-- col-sm-6 -->
                                
                                <div class="col-sm-12">
                                    <div class="pos-relative pr-80">
                                        <p class="color-ash">Message*</p>
                                        <h4><b>Tell us about your question</b></h4>
                                        <textarea class="mb-0" v-model="contactForm.contact_company" ></textarea>
                                        <button class="abs-br font-20 plr-15 btn-fill-primary" type="submit"><i class="ion-ios-paperplane"></i></button>
                                        <p for="" v-if="errorsArr.contact_company" class="text-danger">{{ errorsArr.contact_company }}</p> 
                                    </div><!-- pos-relative -->
                                </div><!-- col-sm-6 --> 
                            </div><!-- row -->
                            <div id="messageSection"></div>                             
                        </form>
                    </div><!-- col-md-6 -->
                    
                    <div class="col-sm-12 col-md-4">
                        <h3 class="mb-20 mt-sm-50"><b>INFORMATION</b></h3>                        
                        <ul class="font-11 list-relative list-li-pl-30 list-block list-li-mb-15">
                            <li><i class="abs-tl ion-ios-location"></i>{{ cDetail.company_address }}</li>
                            <li><i class="abs-tl ion-android-mail"></i>{{ cDetail.company_email }}</li>
                            <li><i class="abs-tl ion-android-call"></i>{{ cDetail.company_phone }}</li> 
                        </ul>
                        <ul class="font-11  list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
                            <li><a class="pl-0" :href="(cDetail.linkedin)?cDetail.linkedin:'javascript:void(0);'"><i class="ion-social-linkedin"></i></a></li>
                            <li><a :href="(cDetail.facebook)?cDetail.facebook:'javascript:void(0);'"><i class="ion-social-facebook"></i></a></li>
                            <li><a :href="(cDetail.twitter?cDetail.twitter:'javascript:void(0);')"><i class="ion-social-twitter"></i></a></li>
                            <li><a :href="(cDetail.google?cDetail.google:'javascript:void(0);')"><i class="ion-social-google"></i></a></li>
                            <li><a :href="(cDetail.pinterest?cDetail.pinterest:'javascript:void(0);')"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    
                    </div><!-- col-md-6 -->
                </div><!-- row -->
            </div><!-- container -->
        </section>
    </div>
</template>
<script>
    export default { 
        name : "contactUs",
        data : function(){
          return {
            cDetail : [],
            contactForm : {
                contact_subject:'',
                contact_fullname:'',
                contact_email:'',
                contact_phone:'',
                contact_message:'',
                contact_company:'' 
            },
            errorsArr : []
          }
        },
        methods:{
            contactDetail(){  
                let _this = this; 
                this.$store.dispatch('contactDetail')
                .then(function(data){  
                    _this.cDetail = data.data; 
                }); 
            },
            resetForm(){
                this.contactForm = {
                    contact_subject : '',
                    contact_fullname:'',
                    contact_email:'',
                    contact_phone:'',
                    contact_message:'',
                    contact_company:'' 
                }
            },
            contactFormSubmit(){
                let _this = this; 
                _this.errorsArr = [];
                _this.$store.dispatch('contactDetailSave',_this.contactForm)
                .then(function(data){  
                    if( typeof(data.status)!='undefined' && data.status == true){
                         _this.resetForm();
                        _this.$toastr.s(data.message,'Success!!');
                    }else if( typeof(data.status)!='undefined' && data.status == false){
                        _this.$toastr.e(data.message,'Warning!!'); 
                        _this.errorsArr = data.result.errors;
                    }else{ 
                        _this.$toastr.e('Opps!! something went wrong..');
                    } 
                });                 
            }           
        },
        created(){
            this.contactDetail();           
        } 
    }
</script>
<style scoped>
   .warningAlert,.successAlert {
        margin-top: 24px;
    }
</style>