<template>
    <div id="bloglist-home"> 
        <div class="container">
		<div class="h-600x h-sm-auto">
			<div class="h-2-3 h-sm-auto oflow-hidden">
		
				<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
					<router-link :to="`/s/${homeTop1.blog_url}`" class="pos-relative h-100 dplay-block"> 
						<img v-lazy="`/images/${ homeTop1.blog_image?homeTop1.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" class="img-bg bg-1 bg-grad-layer-6">
						<div class="abs-blr color-white p-20 bg-sm-color-7">
							<h3 class="mb-15 mb-sm-5 font-sm-13"><b>{{ (homeTop1.blog_title)?homeTop1.blog_title:'' }}</b></h3>
							<ul class="list-li-mr-20">   
								<li>by <span class="color-primary"><b>Admin</b></span> {{ homeTop1.created_at | moment('MMM DD, YYYY') }}</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li> 
							</ul>
						</div><!--abs-blr -->
					</router-link><!-- pos-relative -->
				</div><!-- w-1-3 -->
				
				<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x"> 
					<div v-for="(t2,key) in homeTop2" v-bind:key="key" class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
						<router-link :to="`/s/${t2.blog_url}`" class="pos-relative h-100 dplay-block"> 
							<img v-lazy="`/images/${ t2.blog_image?t2.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" class="img-bg bg-2 bg-grad-layer-6"> 
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b>{{ t2.blog_title }}</b></h4>
								<ul class="list-li-mr-20">
									<li>{{ t2.created_at | moment('MMM DD, YYYY') }}</li>
									<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
									<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
								</ul>
							</div><!--abs-blr -->
						</router-link><!-- pos-relative -->
					</div><!-- w-1-3 -->  
				</div><!-- float-left --> 
			</div><!-- h-2-3 -->
			
			<div class="h-1-3 oflow-hidden">
		
				<div v-for="(t3,key) in homeTop3" v-bind:key="key" class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
					<router-link :to="`/s/${t3.blog_url}`" class="pos-relative h-100 dplay-block"> 
						<img v-lazy="`/images/${ t3.blog_image?t3.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" class="img-bg bg-4 bg-grad-layer-6">
						 <div class="abs-blr color-white p-20 bg-sm-color-7">
							<h4 class="mb-10 mb-sm-5"><b>{{ t3.blog_title }}</b></h4>
							<ul class="list-li-mr-20">
								<li>{{ t3.created_at | moment('MMM DD, YYYY') }}</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
							</ul>
						</div><!--abs-blr -->
					</router-link><!-- pos-relative -->
				</div><!-- w-1-3 --> 
				
			</div><!-- h-2-3 -->
		</div><!-- h-100vh -->
	</div> 
        <section> 
            <div class="container">
              <div class="row"> 
                <div class="col-md-12 col-lg-8"> 
                  <h4 class="p-title"><b>Recent &amp; Featured Post</b></h4>
                  <div class="row">   
                    <div v-for="(recent,key) in homeRecent" v-bind:key="key" class="col-sm-6 homeList"> 
                      <router-link :to="`/s/${recent.blog_url}`">
                        <img v-lazy="`/images/${ recent.blog_image?recent.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" alt="">
                      </router-link>
                      <h4 class="pt-20">
                        <router-link :to="`/s/${ (recent.blog_url) }`">{{ recent.blog_title }}</router-link>
                        </h4>
                      <ul class="list-li-mr-20 pt-10 mb-30">
                        <li class="color-lite-black">by <router-link :to="`/s/${recent.blog_url}`" class="color-black"><b>Admin,</b></router-link>
                        {{ recent.created_at | moment('MMM DD, YYYY') }}</li>
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
                  <!-- <a class="dplay-block btn-brdr-primary mt-20 mb-md-50" @click.prevent="loadHomeMore()"><b>LOAD MORE</b></a> -->
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
        name : "blogHome",
        data : function(){
          return {
              homeTop1 :[],
              homeTop2 :[],
              homeTop3 :[],
              homeRecent:[],
              pageCount:0,
              filterData:{
                pageNo:1
              } 
          }           
        },
        methods:{  
            homeTopBlog(){
                let _this = this; 
                this.$store.dispatch('homeTopBlogs')
                .then(function(data){  
                    _this.homeTop1 = data.data.topbig[0];
                    _this.homeTop2 = data.data.topleft;
                    _this.homeTop3 = data.data.topbottom;
                }); 
            },
            homeRecentBlog(){
                let _this = this; 
                this.$store.dispatch('homeRecentBlogs',this.filterData)
                .then(function(data){  
                    _this.homeRecent = data.data;
                    _this.pageCount = parseInt(data.count);
                }); 
            },
            paginatePost(pageNum){
              this.filterData.pageNo = pageNum; 
              this.homeRecentBlog();
            } 
          },
          created(){
            this.homeTopBlog(); 
            this.homeRecentBlog();          
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