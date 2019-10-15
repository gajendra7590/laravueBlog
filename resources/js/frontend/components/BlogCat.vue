<template>
    <div id="bloglist-category"> 
        <section class="ptb-0">
            <div class="mb-30 brdr-ash-1 opacty-5"></div>
            <div class="container">
              <router-link class="mt-10" :to="`/`"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></router-link>
              <a class="mt-10 color-ash" href="javascript:void(0);">{{ blogCatName | camelcase }}</a>
            </div><!-- container -->
        </section>
        <section>
            <div class="container">
              <div class="row">
              
                <div class="col-md-12 col-lg-8">
                  
                  <h4 class="p-title"><b>{{ blogCatName | camelcase }}</b></h4>
                  <div class="row"> 
                    
                    <div v-for="(blog,key) in blogList" v-bind:key="key" class="col-sm-6">
                      <router-link :to="`/s/${ blog.blog_url }`" class="color-black">
                      <img v-lazy="`/images/${ blog.blog_image?blog.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" alt="">
                      <h4 class="pt-20"><router-link :to="`/s/${ blog.blog_url }`"><b>{{ blog.blog_title }}</b></router-link></h4>
                      </router-link>
                      <ul class="list-li-mr-20 pt-10 mb-30">
                        <li class="color-lite-black">by <router-link :to="`/s/${ blog.blog_url }`" class="color-black"><b>Admin,</b></router-link>
                        {{ blog.created_at | moment('MMM DD, YYYY') }}</li>
                        <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
                        <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
                      </ul>
                    </div><!-- col-sm-6 -->
                    
                  </div><!-- row -->
                  <hr/>
                   <div class="pagination-container">
                        <paginate
                        :page-count="pageCount" 
                        :page-range="3"
                        :margin-pages="2"
                        :click-handler="paginatePost"
                        :prev-text="'Prev'"
                        :prev-class="'page-item'"
                        :prev-link-class="'page-link'"
                        :next-text="'Next'"
                        :next-class="'page-item'"
                        :next-link-class="'page-link'"
                        :container-class="'pagination'"
                        :page-class="'page-item'"
                        :page-link-class="'page-link'">
                        </paginate> 
                   </div>
                  
                  <!-- <a class="dplay-block btn-brdr-primary mt-20 mb-md-50" @click.prevent="loadmoreCat"><b>LOAD MORE</b></a> -->
                </div><!-- col-md-9 --> 
                <div class="d-none d-md-block d-lg-none col-md-3"></div> 
                 
                 <!-- Sidebar common component -->
                 <sidebarc></sidebarc>

              </div><!-- row -->
            </div><!-- container -->
          </section>
               
    </div>
</template>
<script>
import SideBar from './common/PostSidebar';
    export default {
        components:{
          'sidebarc':SideBar
        },
        name : "blogCategory",
        data : function(){
          return {
              blogCatName :'NA',
              blogCatDetail : [],
              blogList :[],
              pageCount:0,
              filterData:{
                pageNo:1
              }
          }
        },
        methods:{
           blogsByCategory(){ 
                var catName = this.$route.params.caturl; 
                this.blogCatName = catName;
                let _this = this; 
                this.$store.dispatch('blogsByCategory',{catName:catName,filterData:this.filterData})
                .then(function(data){  
                    _this.blogList = data.data; 
                }); 
            },
            paginatePost(pageNum){
              this.filterData.pageNo = pageNum; 
              this.blogsByCategory();
            }          
        },
        created(){ 
          this.blogsByCategory();            
        },
        watch: { 
          '$route': 'blogsByCategory'
        }, 
        filters:{
            blogTitlefilter : function(value){
              if (!value) return ''
              value = value.toString()
              return value.charAt(0).toUpperCase() + value.slice(1)

            }
        } 
    }
</script>
<style scoped> 
  .pagination-container { 
      width: 70%;
      float: right;
      margin: 0px;
      padding: 14px;
  } 
</style>