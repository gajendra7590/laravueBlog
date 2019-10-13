<template>
    <div id="profilec"> 
         
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
            </div>
            <div class="card-body"> 
           <div class="col-xl-6 col-md-6 mb-6">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">  
                      <div class="col col-md-12">
                      <div class="image-section">
                            <div class="profile-img">
                                <h5>Profile Image</h5>
                                <hr />
                                <b-img id="profileImg" :src="profileLogo" rounded alt="Rounded image"></b-img> 
                            </div>
                       </div>    
                      
                        <hr />  
                        <b-form @submit.prevent="onSubmit" id="userForm" enctype='multipart/form-data'>
                                <b-form-group
                                    id="userName"                                 
                                    label="User name"
                                    label-for="User name" >
                                <b-form-input
                                id="input-1"
                                name="name"
                                v-model="userData.name"
                                type="text" 
                                placeholder="Enter user name"
                                ></b-form-input>
                                <p for="" v-if="errorsArr.name" class="text-danger">{{ errorsArr.name }}</p>
                            </b-form-group> 

                            <b-form-group id="userEmail" label="Email Address" label-for="User email">
                                <b-form-input
                                id="userEmail"
                                name="email"
                                v-model="userData.email" 
                                placeholder="Enter name"
                                > 
                            </b-form-input>
                            <p for="" v-if="errorsArr.email" class="text-danger">{{ errorsArr.email }}</p>
                            </b-form-group> 

                             <b-form-group id="userPhone" label="Phone" label-for="User phone">
                                <b-form-input
                                id="userPhones"
                                name="phone"
                                v-model="userData.phone" 
                                placeholder="Enter phone"
                                > 
                            </b-form-input>
                            <p for="" v-if="errorsArr.phone" class="text-danger">{{ errorsArr.phone }}</p>
                            </b-form-group> 

                             <b-form-group id="userAddress" label="User Address" label-for="User Address">
                                <b-form-input
                                id="userAddresss"
                                name="address"
                                v-model="userData.address" 
                                placeholder="Enter address"
                                > 
                            </b-form-input>
                            <p for="" v-if="errorsArr.address" class="text-danger">{{ errorsArr.address }}</p>
                            </b-form-group> 

                            <b-form-group id="userfile" label="Profile Image" label-for="Profile Image">
                                <b-form-file
                                name = "file"
                                type="file"
                                id = "userfile" 
                                v-on:change = "onImageChange" 
                                > 
                            </b-form-file>
                             <p for="" v-if="errorsArr.file" class="text-danger">{{ errorsArr.file }}</p>
                            </b-form-group>   
                            <br />
                            <hr />
                            <b-button type="submit" variant="primary" class="float-right">Save Profile</b-button> 
                    </b-form> 
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
        name : "profilec",
        data:function(){
            return {
                userData : [],
                profileLogo : null, 
                show:true,
                errorsArr:[]
            }
        },
        methods : {
            onSubmit(){
              let _this = this; 
              _this.errorsArr = [];
              var form = $('#userForm')[0];
              var formData = new FormData(form);
              this.$store.dispatch('updateProfile',formData)
              .then(function(data){  
                  if(typeof(data.status)!='undefined' && data.status == true){
                   _this.$toastr.s(data.message,'SUCCESS!'); 
                   _this.userProfile();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                     _this.$toastr.e(data.message,'Warning!'); 
                   } 
                 }else{

                 }
              }); 
                
            }, 
            userProfile(){ 
                let _this = this;
                this.$store.dispatch('userProfile')
                .then(function(data){   
                    _this.userData = data.result.data;
                    _this.$store.state.getProfile = data.result.data;  
                    _this.profileLogo = (data.result.data.image)?`/images/${data.result.data.image}`:'/images/default/user_default.png';
                });
            },
            onImageChange(e){
               const file = e.target.files[0];
               this.profileLogo = URL.createObjectURL(file);
            }
        },
        mounted(){ 
            this.userProfile();
        }
        
    }
</script>
<style scoped>
    img.rounded {
        height: 170px;
        width: 170px;
        border-radius: 50% !important;
    }
    .pimage-div{
        margin-top: -194px; 
    }
    .profile-img{
        text-align:center;
    }
    .profile-img {
        border: 1px solid;
        padding: 7px;
        width: 41%;
        border-radius: 17%;
        margin-left: 29%;
    }
    /* .col.col-md-5 {
        border: 1px solid;
        padding: 29px;
    } */
</style>