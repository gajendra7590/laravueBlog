<template>
    <div id="blogsc"> 
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
            <a href="#" @click.prevent="addBlog()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa fa-plus-circle fa-sm text-white-50"></i> Add Blog</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Blogs List</h6>
            </div>
            <div class="card-body">
                <div id="people">
                    <v-client-table :data="tableData" :columns="columns" :options="options"> 
                          <div slot="blog_image" slot-scope="props">
                            <img :src="`/images/${ (props.row.blog_image)?props.row.blog_image:'default-thumbnail.jpg' }`" class="list-img" />
                          </div> 
                          <div slot="action" slot-scope="props">
                             <a v-on:click.prevent="editBlog(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                              Edit 
                            </a>
                            <a v-on:click.prevent="deleteBlog(props.row.id)" :href="props.row.id" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                              Delete 
                            </a>   
                          </div> 
                    </v-client-table> 
                </div>
            </div>
          </div> 
          <b-modal id="blogModal" hide-footer :title=modelTitle data-backdrop="static" :noCloseOnBackdrop=noclose :noCloseOnEsc=noclose>
            <b-form id="blogformId" @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate>  
                <b-form-group label="Blog Name">
                  <b-form-input
                    id="shortname"  
                    name="blog_name"
                    placeholder="Enter blog name.."
                    v-model="formData.blog_name"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.blog_name" class="text-danger">{{ errorsArr.blog_name  }}</p>
                </b-form-group> 

                <b-form-group label="Blog Title">
                  <b-form-input
                    id="blogtitle"  
                    name="blog_title"
                    v-model="formData.blog_title"
                    placeholder="Enter blog title.."
                    @keyup="MakeURL($event.target.value)"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.blog_title" class="text-danger">{{ errorsArr.blog_title }}</p>
                </b-form-group>

                <b-form-group label="Blog URL">
                  <b-form-input
                    id="blogurl"  
                    name="blog_url"
                    v-model="formData.blog_url"
                    placeholder="Enter blog URL.."
                    readonly="readonly"
                  ></b-form-input> 
                  <p for="" v-if="errorsArr.blog_url" class="text-danger">{{ errorsArr.blog_url }}</p>
                </b-form-group>

                 <b-form-group label="Blog Category">
                   <b-form-select name="blog_category" v-model="formData.blog_category" :options="blogCategories">  
                      <template v-slot:first>
                        <option :value="null" disabled>-- Please select an category --</option>
                      </template>
                   </b-form-select>
                  <p for="" v-if="errorsArr.blog_category" class="text-danger">{{ errorsArr.blog_category }}</p>
                </b-form-group>

                <b-form-group label="Blog description">
                <vue-editor id="blog_desc" name="blog_desc" v-model="formData.blog_desc" style="max-height: 350px; overflow-y: auto"></vue-editor>
                <!-- <b-form-textarea
                  id="blogdescription" 
                  name="blog_desc"
                  v-model="formData.blog_desc"
                  placeholder="Enter description,,"
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>   -->
                <p for="" v-if="errorsArr.blog_desc" class="text-danger">{{ errorsArr.blog_desc }}</p>
                </b-form-group>  

                <img v-if="(formData.blog_image)" :src="formData.blog_image" class="list-img">
                <b-form-group label="Choose Blog Image">
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
    import { VueEditor } from "vue2-editor";
    export default {
        components: {
          VueEditor
        },
        name : "blogsc",
        data:function(){
          return {
                  columns: [
                    'id','blog_image','blog_name','blog_title','user.name',
                    'category.category_name','created_at','action'
                  ], 
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
                    },
                    headings: {
                      'blog_image' : 'Image',
                      'blog_name' : 'Short Name',
                      'blog_title' : 'Blog Title',
                      'category.category_name' : 'Category',
                      'user.name' : 'Created By',
                      'created_at':'Created Date' 
                    } 
                  }, 
                  formData : {
                    blog_name : '',
                    blog_category : null,
                    blog_title : '',
                    blog_url : '',
                    blog_desc : '',
                    blog_image : '',
                    blog_location : ''
                  },
                  blog_id : 0,
                  blogCategories : [],
                  BootstrapVue : 'Create New Blog',
                  noclose: true, 
                  modelTitle : 'Add Blog',
                  btnLabel : 'Create Blog',
                  errorsArr : []   
          }
        },
        methods:{
          getblogs(){               
              let _this = this; 
              this.$store.dispatch('blogsList')
              .then(function(data){ 
                  _this.tableData = data.data;
              }); 
          },
           blogsCategories(){               
              let _this = this; 
              this.$store.dispatch('blogCategories')
              .then(function(data){  
                  _this.blogCategories = data.data;
              }); 
          },
          addBlog(){
             this.resetForm();
             this.blogsCategories();
             this.$bvModal.show('blogModal');
          },
          editBlog(id){
              let _this = this; 
              this.$store.dispatch('editBlog',id)
              .then(function(data){  
                  _this.formData = data.data
                  _this.formData.blog_image = `/images/${data.data.blog_image}`;
                  _this.modelTitle = 'Edit Blog';
                  _this.btnLabel = 'Update Blog';
                  _this.blog_id = id;
                  _this.blogsCategories();
                  _this.$bvModal.show('blogModal');
              }); 
          },
          updateBlog(id){
              let _this = this; 
              var form = $('#blogformId')[0];
              var formData = new FormData(form);
              formData.append('blog_desc',this.formData.blog_desc);
              formData.append('id',id);
              this.$store.dispatch('updateBlog',formData)
              .then(function(data){  
                 if(typeof(data.status)!='undefined' && data.status == true){
                    _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                    _this.$bvModal.hide('blogModal'); 
                    _this.getblogs();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 } 
                  
              });              
          },
          saveBlog(){ 
              let _this = this; 
              var form = $('#blogformId')[0];
              var formData = new FormData(form);
              formData.append('blog_desc',this.formData.blog_desc);
              this.$store.dispatch('saveBlog',formData)
              .then(function(data){  
                  if(typeof(data.status)!='undefined' && data.status == true){
                   _this.$toastr.s(data.message,'SUCCESS!');
                    _this.resetForm();
                   _this.$bvModal.hide('blogModal'); 
                   _this.getblogs();
                 }else if(typeof(data.status)!='undefined' && data.status == false){
                   if(data.result.errors != null || data.result.errors != ''){
                     _this.errorsArr = data.result.errors;
                   } 
                 }else{

                 }
              }); 
          },
          onSubmit(){
             if(this.blog_id > 0){
               this.updateBlog(this.blog_id);
             }else{
               this.saveBlog();
             }
          },
          deleteBlog(id){
              let _this = this;  
              this.$bvModal.msgBoxConfirm('Are you sure to delete this blog ?', {
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
                      _this.$store.dispatch('deleteBlog',id)
                      .then(function(data){  
                          if(typeof(data.status)!='undefined' && data.status == true){
                            _this.$toastr.s(data.message,'SUCCESS!'); 
                            _this.getblogs();
                        }else if(typeof(data.status)!='undefined' && data.status == false){
                          if(data.result.errors != null || data.result.errors != ''){
                            _this.errorsArr = data.result.errors;
                          } 
                        } 
                      }); 
                  }
              });  
          },
          resetForm(){
            this.modelTitle = 'Create New Blog',
            this.btnLabel = 'Create Blog',
            this.errorsArr = [],
            this.blog_id = 0,
            this.formData = {
                blog_name : '',
                blog_category : null,
                blog_url : '',
                blog_title : '',
                blog_desc : '',
                blog_image : '',
                blog_location : ''
            } 
          },
          onImageChange(e){
              const file = e.target.files[0];
              this.formData.blog_image = URL.createObjectURL(file);
          },
          MakeURL(title){
            let titlenew = title.toLowerCase().trim().replace(/[^a-zA-Z ]/g, "").replace(/  +/g, ' ').replace(/ /g, "-");
            this.formData.blog_url = titlenew; 
          } 
        },
        created(){
          this.getblogs();
          this.blogsCategories();
        } 
    }
</script>
<style>
  .list-img{
      height: 100px;
      width:100px;
      border-radius: 48px;
  }
  .VueTables.VueTables--client label {
      float: left;
      padding: 10px;
  } 
</style>