<template>
    <div id="bloglist-category"> 
        <section class="ptb-0">
            <div class="mb-30 brdr-ash-1 opacty-5"></div>
            <div class="container">
              <a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
              <a class="mt-10 color-ash" href="archive-page.html">Blog Archive</a>
            </div><!-- container -->
        </section>
        <section>
            <div class="container">
              <div class="row">
              
                <div class="col-md-12 col-lg-8">
                  
                  <h4 class="p-title"><b>GIDES &amp; ANLYTICS</b></h4>
                  <div class="row"> 
                    
                    <div class="col-sm-6">
                      <img src="/frontend/images/crypto-news-1-600x450.jpg" alt="">
                      <h4 class="pt-20"><a href="#"><b>2017 Market Performance: Crypto vs.Stock</b></a></h4>
                      <ul class="list-li-mr-20 pt-10 mb-30">
                        <li class="color-lite-black">by <a href="#" class="color-black"><b>Olivia Capzallo,</b></a>
                        Jan 25, 2018</li>
                        <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
                        <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>47</li>
                      </ul>
                    </div><!-- col-sm-6 -->
                    
                  </div><!-- row -->
                  
                  <a class="dplay-block btn-brdr-primary mt-20 mb-md-50" href="#"><b>LOAD MORE</b></a>
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
            blogList :[],
          }
        },
        methods:{
           blogsByCategory(){

             //console.log(this.$root.$router)
                let _this = this; 
                this.$store.dispatch('blogsByCategory')
                .then(function(data){  
                    _this.blogList = data.data; 
                }); 
            },
            loadmoreCat(){

            }           
        },
        created(){
          this.blogsByCategory();            
        } 
    }
</script>