<template>  
    <div class="footerc">
          	<footer class="bg-191 color-ccc">		
				<div class="container">
					<div class="pt-50 pb-20 pos-relative">
						<div class="abs-tblr pt-50 z--1 text-center">
							<div class="h-80 pos-relative"><img class="opacty-1 h-100 w-auto" src="/frontend/images/map.png" alt=""></div>
						</div>
						<div class="row">						
							<div class="col-sm-4">
								<div class="mb-30">
									<a href="#"><img src="/frontend/images/logo-white.png"></a>
									<p class="mtb-20 color-ccc">
										Laravue is an simple blog site to provide important and latest information about science,social media,technologies related etc.., 
										its free of cost you do not have to pay anything for new.</p>
									<p class="color-ash">
		                              VueLara Blog Copyright &copy;{{ new Date() | moment("YYYY") }}  All rights reserved. 
		                            </p>
								</div><!-- mb-30 -->
							</div><!-- col-md-4 -->
							
							<div class="col-sm-4">
								<div class="mb-30">
									<h5 class="color-primary mb-20"><b>MOST POPULAR</b></h5>
									<div v-for="(lb,key) in mpBlogFooterLeft" v-bind:key="key">
										<div class="mb-20"> 
											<router-link :to="`/s/${lb.blog_url}`" class="color-white"><b>{{ lb.blog_title }}</b></router-link>
											<h6 class="mt-10">{{ lb.created_at | moment("MMM DD, YYYY") }}</h6>
										</div> 
									</div>
								</div><!-- mb-30 -->
							</div><!-- col-md-4 -->
							
							<div class="col-sm-4">
								<div class="mb-30">
									<h5 class="color-primary mb-20"><b>MOST POPULAR</b></h5>
									 <div v-for="(rb,key) in mpBlogFooterRight" v-bind:key="key">
										<div class="mb-20"> 
											<router-link :to="`/s/${rb.blog_url}`" class="color-white"><b>{{ rb.blog_title }}</b></router-link>
											<h6 class="mt-10">{{ rb.created_at | moment("MMM DD, YYYY") }}</h6>
										</div> 
									</div>
								</div><!-- mb-30 -->
							</div><!-- col-md-4 -->
							
						</div><!-- row -->
					</div><!-- ptb-50 -->
					
					<div class="brdr-ash-1 opacty-2"></div>
					
					<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">
					
						<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
							<li><router-link :to="`/faq`">FAQ</router-link></li>
							<li><router-link :to="`/about-us`">About</router-link></li>
							<li><router-link :to="`/contact-us`">Contact</router-link></li>
						</ul>
						<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
							<li><a class="pl-0 pl-sm-10" href="javascript:viod(0);"><i class="ion-social-facebook"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-twitter"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-google"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-instagram"></i></a></li>
							<li><a href="javascript:viod(0);"><i class="ion-social-bitcoin"></i></a></li>
						</ul>
						
					</div><!-- oflow-hidden -->
				</div><!-- container -->
	</footer>
    </div>
</template>
<script>
    export default {
        name : "footerc",
        data : function(){
          return {
			mpBlogFooterLeft :[],
			mpBlogFooterRight :[]
          }           
        },
        methods:{  
          top2FootLeft(){
              let _this = this; 
              this.$store.dispatch('top2FootLeft')
              .then(function(data){  
                  _this.mpBlogFooterLeft = data.data;
              }); 
		  },
		   top2FootRight(){
              let _this = this; 
              this.$store.dispatch('top2FootRight')
              .then(function(data){  
                  _this.mpBlogFooterRight = data.data;
              }); 
          }

        },
        created(){
		  this.top2FootLeft();  
		  this.top2FootRight();         
        }
    }
</script>