<template>
    <div id="usersc"> 
         <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
            <a href="#" @click.prevent="addUser()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa fa-plus-circle fa-sm text-white-50"></i> Add User</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <div id="people">
                    <v-client-table :data="tableData" :columns="columns" :options="options"> 
                          <div slot="image" slot-scope="props">
                            <img :src="`/images/${ (props.row.image)?props.row.image:'default-thumbnail.jpg' }`" class="list-img" />
                          </div>
                          <div slot="email" slot-scope="props">
                            <span v-if="props.row.email">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                 {{ props.row.email }}
                            </span>
                            <span v-if="!(props.row.email)"> 
                                  ---
                            </span> 
                          </div>
                          <div slot="phone" slot-scope="props">
                            <span v-if="props.row.phone">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                 {{ props.row.phone }}
                            </span>
                            <span v-if="!(props.row.phone)"> 
                                  ---
                            </span> 
                          </div>
                          <div slot="active" slot-scope="props">
                               <b-badge v-if=" (props.row.active == '1')" @click="changeStatus(props.row.id,0)" title="Change Status" pill variant="success">Active</b-badge>
                               <b-badge v-if=" (props.row.active == '0')" @click="changeStatus(props.row.id,1)" title="Change Status" pill variant="danger">InActive</b-badge>
                          </div>
                          <div slot="action" slot-scope="props">
                             <a v-on:click.prevent="editUser(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                              Edit 
                            </a>
                            <a v-on:click.prevent="deleteUser(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                              Delete 
                            </a>   
                          </div> 
                    </v-client-table> 
                </div>
            </div>
          </div> 
          <b-modal id="userModal" hide-footer :title=modelTitle data-backdrop="static" :noCloseOnBackdrop=noclose :noCloseOnEsc=noclose>
            <b-form id="userformId" @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate>  
                <b-form-group label="User name">
                  <b-form-input
                    id="name"  
                    name="name"
                    placeholder="Enter user name.."
                    v-model="formData.name"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.name" class="text-danger">{{ errorsArr.name  }}</p>
                </b-form-group> 

                <b-form-group label="User email">
                  <b-form-input
                    id="email"  
                    name="email"
                    v-model="formData.email"
                    placeholder="Enter user email.."
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.email" class="text-danger">{{ errorsArr.email }}</p>
                </b-form-group>  

                 <b-form-group label="User phone">
                  <b-form-input
                    id="phone"  
                    name="phone"
                    placeholder="Enter user phone.."
                    v-model="formData.phone"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.phone" class="text-danger">{{ errorsArr.phone  }}</p>
                </b-form-group> 
                
                 <b-form-group label="User address">
                  <b-form-input
                    id="address"  
                    name="address"
                    placeholder="Enter user address.."
                    v-model="formData.address"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.address" class="text-danger">{{ errorsArr.address  }}</p>
                </b-form-group> 

                <b-form-group label="User status">
                  <b-form-select v-model="formData.active" :options="statusList"></b-form-select>
                  <p for="" v-if="errorsArr.name" class="text-danger">{{ errorsArr.name  }}</p>
                </b-form-group> 

                <img v-if="(formData.image)" :src="formData.image" class="list-img">
                <b-form-group label="Choose User Image">
                    <b-form-file name="file" accept="image/*" @change="onImageChange"></b-form-file>
                    <p for="" v-if="errorsArr.file" class="text-danger">{{ errorsArr.file }}</p>
                </b-form-group>

                <hr>
                <b-button class="float-right"	type="submit" variant="primary btn-md">{{ btnLabel }}</b-button>
            </b-form>
          </b-modal>
    </div>
</template>
<script>
    export default {
        name : "usersc",
        data:function(){
          return {
                  columns: ['id','image','name', 'email','phone','active','action'],
                  tableData: [],
                  options: {  
                    sortable: [],
                    perPage: 10,
                    orderBy: {
                        column: 'id',
                        ascending: false
                    },
                    perPageValues:[5,10,15,20,25] ,
                    pagination:{
                      chunk : 5
                    } 
                  }, 
                  formData : {
                    name : '',
                    email : '',
                    phone : '',
                    address : '',
                    active : 1,
                    image : '', 
                  },
                  statusList:[
                        { value: '', text: 'Please select status' },
                        { value: 0, text: 'Inactive' },
                        { value: 1, text: 'Active' } 
                   ],
                  user_id : 0,
                  BootstrapVue : 'Create New User',
                  noclose: true, 
                  modelTitle : 'Add User',
                  btnLabel : 'Create User',
                  errorsArr : []   
          }
        },
        methods:{ 
          resetForm(){
            this.modelTitle = 'Create New User',
            this.btnLabel = 'Create User',
            this.errorsArr = [],
            this.user_id = 0,
            this.formData = {
                name : '',
                email : '',
                phone : '',
                address : '',
                active : 1,
                image : '', 
            } 
          },
          onImageChange(e){
              const file = e.target.files[0];
              this.formData.image = URL.createObjectURL(file);
          },  
          getUsers(){               
              let _this = this; 
              this.$store.dispatch('usersList')
              .then(function(data){ 
                  _this.tableData = data.data;
              }); 
          },
          addUser(){
             this.resetForm();
             this.$bvModal.show('userModal');
          },
          editUser(id){
              let _this = this; 
              this.$store.dispatch('editUser',id)
              .then(function(data){  
                  _this.formData = data.data
                  _this.formData.image = `/images/${data.data.image}`;
                  _this.modelTitle = 'Edit User';
                  _this.btnLabel = 'Update User';
                  _this.user_id = id;
                  _this.$bvModal.show('userModal');
              }); 
          },
          updateUser(id){
              let _this = this; 
              var form = $('#userformId')[0];
              var formData = new FormData(form);
              formData.append('id',id);
              this.$store.dispatch('updateUser',formData)
              .then(function(data){  
                 if(typeof(data.status)!='undefined' && data.status == true){
                    _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                    _this.$bvModal.hide('userModal'); 
                    _this.getUsers();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 } 
                  
              });              
          },
          saveUser(){
              let _this = this; 
              var form = $('#userformId')[0];
              var formData = new FormData(form);
              this.$store.dispatch('saveUser',formData)
              .then(function(data){  
                  if(typeof(data.status)!='undefined' && data.status == true){
                   _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                   _this.$bvModal.hide('userModal'); 
                   _this.getUsers();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 }
              }); 
          },
          onSubmit(){
             if(this.user_id > 0){
               this.updateUser(this.user_id);
             }else{
               this.saveUser();
             }
          },
          deleteUser(id){
              let _this = this;  
              this.$bvModal.msgBoxConfirm('Are you sure to delete this user ?', {
                  title: 'Delete Confirmation!!',
                  size: 'md',
                  buttonSize: 'md',
                  okVariant: 'danger',
                  okTitle: 'Yes',
                  cancelTitle: 'No',
                  footerClass: 'p-2',
                  hideHeaderClose: false 
              }).then(value => {
                  if(value == true){ 
                      _this.$store.dispatch('deleteUser',id)
                      .then(function(data){  
                          if(typeof(data.status)!='undefined' && data.status == true){
                            _this.$toastr.s(data.message,'SUCCESS!'); 
                            _this.getUsers();
                        }else if(typeof(data.status)!='undefined' && data.status == false){
                          if(data.result.errors != null || data.result.errors != ''){
                            _this.errorsArr = data.result.errors;
                          } 
                        } 
                      }); 
                  }
              });  
          },
          changeStatus(id,status){ 
              let _this = this;  
              this.$bvModal.msgBoxConfirm('Sure to change the status?', {
                  title: 'Change status!!',
                  size: 'md',
                  buttonSize: 'md',
                  okVariant: 'danger',
                  okTitle: 'Yes',
                  cancelTitle: 'No',
                  footerClass: 'p-2',
                  hideHeaderClose: false 
              }).then(value => {
                  if(value == true){ 
                      _this.$store.dispatch('changeStatusUser',{id:id,status:status})
                      .then(function(data){  
                          if(typeof(data.status)!='undefined' && data.status == true){
                            _this.$toastr.s(data.message,'SUCCESS!'); 
                            _this.getUsers();
                        }else if(typeof(data.status)!='undefined' && data.status == false){
                          if(data.result.errors != null || data.result.errors != ''){
                            _this.errorsArr = data.result.errors;
                          } 
                        } 
                      }); 
                  }
              });  
          }
        },
        created(){
          this.getUsers();
        }  
    }
</script>
<style scoped>
   span.badge.badge-danger,span.badge.badge-success {
        cursor: pointer;
    }
</style>