<template>
    <div id="blog-single"> 
       <section class="ptb-0">
            <div class="mb-30 brdr-ash-1 opacty-5"></div>
            <div class="container">
                <router-link class="mt-10" :to="`/`"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></router-link>
                <router-link class="mt-10" :to="`/cat/${blogCategory.category_url}`">{{ blogCategory.category_name }}<i class="mlr-10 ion-chevron-right"></i></router-link>
                <a class="mt-10 color-ash" href="javascript:void(0);">{{ blogName }}</a>
            </div><!-- container -->
        </section>
        <section>
            <div class="container">
              <div class="row">

                  <div class="col-md-12 col-lg-8">
					  <!-- sblog -->
					<img v-lazy="`/images/${ sblog.blog_image?sblog.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" alt="">
					<h3 class="mt-30"><b>{{ sblog.blog_title }}</b></h3>
					<ul class="list-li-mr-20 mtb-15">
						<li>by <a href="#"><b>Admin </b></a> {{ sblog.created_at | moment('MMM DD, YYYY') }}</li>
						<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
						<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
					</ul> 

					<div v-html="sblog.blog_desc"> </div> 
					
					<div class="float-left-right text-center mt-40 mt-sm-20">
				
						<ul class="mb-30 list-li-mt-10 list-li-mr-5 list-a-plr-15 list-a-ptb-7 list-a-bg-grey list-a-br-2 list-a-hvr-primary ">
							<li><a href="javascript:viod(0);">MULTIPURPOSE</a></li>
							<li><a href="javascript:viod(0);">FASHION</a></li>
							<li class="mr-0"><a href="javascript:viod(0);">BLOGS</a></li>
						</ul>
						<ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
							<li class="mr-10 ml-0">Share</li>
							<li><a href="javascript:viod(0);"><i class="ion-social-facebook"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-twitter"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-google"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-instagram"></i></a></li>
						</ul>
						
					</div><!-- float-left-right -->
				
					<div class="brdr-ash-1 opacty-5"></div>
					
					<h4 class="p-title mt-50"><b>YOU MAY ALSO LIKE</b></h4>
					<div class="row">
					
						<div v-for="(sblg,key) in singleSimilar" v-bind:key="key" class="col-sm-6">
							<!-- singleSimilar -->
							<router-link :to="`/s/${ sblg.blog_url }`">
							<img v-lazy="`/images/${ sblg.blog_image?sblg.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" alt="">
							</router-link>
							<h4 class="pt-20"><router-link :to="`/s/${ sblg.blog_url }`"><b>{{ sblg.blog_title }}</b></router-link></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <router-link :to="`/s/${ sblg.blog_url }`" class="color-black"><b>Admin,</b></router-link>
								{{ sblg.created_at | moment('MMM DD, YYYY') }}</li>
								<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>0</li>
								<li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>0</li>
							</ul>
						</div><!-- col-sm-6 -->  
					</div><!-- row --> 
				</div> 
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
        name : "blogSingle",
        data : function(){
          return {
			sblog : [],
			singleSimilar : [],
			blogCategory:[],
			blogName:''
          }
        },
        methods:{
			blogSingleDetail(){ 
				var blogurl = this.$route.params.blogurl; 
				this.blogName = blogurl; 
                let _this = this; 
                this.$store.dispatch('singleBlog',blogurl)
                .then(function(data){  
					_this.sblog = data.data.blogDetail[0];  
					_this.blogCategory =  data.data.blogDetail[0].category; 
					_this.smothScroll();
                }); 
			},
			sbSimilarPost(){ 
                var blogurl = this.$route.params.blogurl;  
                let _this = this; 
                this.$store.dispatch('singleBlogSimilarPost',blogurl)
                .then(function(data){  
					_this.singleSimilar = data.data.blogsList;  
                }); 
			},
			smothScroll(){
				$("html, body").stop().animate({scrollTop:0}, 500, 'swing', function(){ });
			}             
        },
        created(){ 
		  this.blogSingleDetail(); 
		  this.sbSimilarPost();           
        },
        watch: { 
		  '$route': 'blogSingleDetail' 
        }
    }
</script>