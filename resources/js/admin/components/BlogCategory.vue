<template>
    <div id="blogcatc"> 
         <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
            <a href="#" @click.prevent="addBlogCategory()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa fa-plus-circle fa-sm text-white-50"></i> Add Category</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
            </div>
            <div class="card-body">
                <div id="people">
                    <v-client-table :data="tableData" :columns="columns" :options="options">                            
                          <div slot="action" slot-scope="props">
                             <a v-on:click.prevent="editBlogCategory(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                              Edit 
                            </a>
                            <a v-on:click.prevent="deleteBlogCategory(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                              Delete 
                            </a>   
                          </div> 
                    </v-client-table> 
                </div>
            </div>
          </div> 
          <b-modal id="blogcatModal" hide-footer :title=modelTitle data-backdrop="static" :noCloseOnBackdrop=noclose :noCloseOnEsc=noclose>
            <b-form id="blogcatformId" @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate>  
                <b-form-group label="Category name">
                  <b-form-input
                    id="category_name"  
                    name="category_name"
                    placeholder="Enter Category name.."
                    v-model="formData.category_name"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.category_name" class="text-danger">{{ errorsArr.category_name  }}</p>
                </b-form-group> 

                <b-form-group label="Category URL">
                  <b-form-input
                    id="category_url"  
                    name="category_url"
                    v-model="formData.category_url"
                    placeholder="Enter Category URL.."
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.category_url" class="text-danger">{{ errorsArr.category_url }}</p>
                </b-form-group>    

                <hr>
                <b-button class="float-right"	type="submit" variant="primary btn-md">{{ btnLabel }}</b-button>
            </b-form>
          </b-modal>
    </div>
</template>
<script>
    export default {
        name : "blogcatc",
        data:function(){
          return {
                  columns: ['id','category_name','category_url','action'],
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
                    category_name : '',
                    category_url : '' 
                  }, 
                  user_id : 0,
                  BootstrapVue : 'Create New Category',
                  noclose: true, 
                  modelTitle : 'Add Category',
                  btnLabel : 'Create Category',
                  errorsArr : []   
          }
        },
        methods:{ 
          resetForm(){
            this.modelTitle = 'Create New Category',
            this.btnLabel = 'Create Category',
            this.errorsArr = [],
            this.category_id = 0,
            this.formData = {
                category_name : '',
                category_url : '' 
            } 
          },  
          getCategories(){               
              let _this = this; 
              this.$store.dispatch('categoriesList')
              .then(function(data){ 
                  _this.tableData = data.data;
              }); 
          },
          addBlogCategory(){
             this.resetForm();
             this.$bvModal.show('blogcatModal');
          },
          editBlogCategory(id){
              let _this = this; 
              this.$store.dispatch('editCategories',id)
              .then(function(data){  
                  _this.formData = data.data 
                  _this.modelTitle = 'Edit Category';
                  _this.btnLabel = 'Update Category';
                  _this.category_id = id;
                  _this.$bvModal.show('blogcatModal');
              }); 
          },
          updateCategory(id){
              let _this = this; 
              var form = $('#blogcatformId')[0];
              var formData = new FormData(form);
              formData.append('id',id);
              this.$store.dispatch('updateCategories',formData)
              .then(function(data){  
                 if(typeof(data.status)!='undefined' && data.status == true){
                    _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                    _this.$bvModal.hide('blogcatModal'); 
                    _this.getCategories();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 } 
                  
              });              
          },
          saveCategory(){
              let _this = this; 
              var form = $('#blogcatformId')[0];
              var formData = new FormData(form);
              this.$store.dispatch('saveCategories',formData)
              .then(function(data){  
                  if(typeof(data.status)!='undefined' && data.status == true){
                   _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                   _this.$bvModal.hide('blogcatModal'); 
                   _this.getCategories();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 }
              }); 
          },
          onSubmit(){
             if(this.category_id > 0){
               this.updateCategory(this.category_id);
             }else{
               this.saveCategory();
             }
          },
          deleteBlogCategory(id){
              let _this = this;  
              this.$bvModal.msgBoxConfirm('Are you sure to delete this blog category ?', {
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
                      _this.$store.dispatch('deleteCategories',id)
                      .then(function(data){  
                          if(typeof(data.status)!='undefined' && data.status == true){
                            _this.$toastr.s(data.message,'SUCCESS!'); 
                            _this.getCategories();
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
          this.getCategories();
        }  
    }
</script>
<style scoped>
   span.badge.badge-danger,span.badge.badge-success {
        cursor: pointer;
    }
</style>