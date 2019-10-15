<template> 
    <div id="headc"> 
       <header>
          <div class="bg-191">
            <div class="container">	
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
              </div><!-- top-menu -->
            </div><!-- container -->
          </div><!-- bg-191 --> 
          <div class="container">
            <router-link :to="`/`" class="logo"><img src="/frontend/images/logo-black.png" alt="Logo"></router-link> 
            <router-link :to="`/search/blog`" class="right-area" >
              <i class="active src-icn ion-search"></i> 
            </router-link>
            <!-- <button class="right-area src-btn" >
              <i class="active src-icn ion-search"></i>
              <i class="close-icn ion-close"></i>
            </button> -->
            <!-- <div class="src-form">
              <form @submit.prevent="globalSearch">
                <input type="text" v-model="searchtext" placeholder="Global Blog Search Here">
                <button type="submit"><i class="ion-search"></i></button>
              </form>
            </div> -->
            <!-- src-form --> 
            <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a> 
            <ul class="main-menu" id="main-menu">
              <li>
                 <router-link :to="`/`">Home</router-link>
              </li>
              <li v-for="(cat,key) in blogCategories" v-bind:key="key">
                 <router-link :to="`/cat/${cat.category_url}`">{{ cat.category_name }}</router-link>
              </li>
              <!-- <li class="drop-down"><a href="03_single-post.html">GUIDES & ANALYTICS<i class="ion-arrow-down-b"></i></a>
                <ul class="drop-down-menu drop-down-inner">
                  <li><a href="#">PAGE 1</a></li>
                  <li><a href="#">PAGE 2</a></li>
                </ul>
              </li> --> 
            </ul>
            <div class="clearfix"></div>
          </div><!-- container -->
        </header> 
    </div>   
</template>
<script>
    export default {
        name : "headc",
        data : function(){
          return {
             blogCategories :[],
             searchtext:''
          }           
        },
        methods:{  
            getTopCategories(){
                let _this = this; 
                this.$store.dispatch('catList')
                .then(function(data){  
                    _this.blogCategories = data.data;
                });  
            },
            globalSearch(){
              // var keyword = this.searchtext;  
              // this.$router.push(`/search/${keyword}`)
              window.location.href = '/search/'+this.searchtext;
            } 
        },
        created(){
          this.searchtext = this.$route.params.keyword;
          this.getTopCategories();  
        } 
    }
</script>
<style scoped> 
</style>