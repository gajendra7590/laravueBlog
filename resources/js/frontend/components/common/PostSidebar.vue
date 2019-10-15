<template> 
        <div class="col-md-6 col-lg-4 post_sidebar">
            <div class="pl-20 pl-md-0"> 
                <h4 class="p-title"><b>POPULAR POSTS</b></h4> 
                <div v-for="(top4,key) in top4Blog" v-bind:key="key"> 
                    <router-link :to="`/s/${ (top4.blog_url) }`" class="oflow-hidden pos-relative mb-20 dplay-block">
                        <div class="wh-100x abs-tlr"><img v-lazy="`/images/${ top4.blog_image?top4.blog_image:'default/blogDefault.jpg' }`" onerror="this.src=`/images/default/blogDefault.jpg`" alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>{{ top4.blog_title }}</b></h5>
                            <h6 class="color-lite-black pt-10">by <span class="color-black"><b>Admin,</b></span> {{ top4.created_at | moment('MMM DD, YYYY') }}</h6>
                        </div>
                   </router-link><!-- oflow-hidden -->  
                </div>        
            <div class="mtb-50 pos-relative">
                <img v-lazy="`/frontend/images/banner-1-600x450.jpg`" alt="">
                <div class="abs-tblr bg-layer-7 text-center color-white">
                <div class="dplay-tbl">
                    <div class="dplay-tbl-cell">
                    <h4><b>Available for mobile &amp; desktop</b></h4>
                    <a class="mt-15 color-primary link-brdr-btm-primary" href="javascript:viod(0);"><b>Download for free</b></a>
                    </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
                </div><!-- abs-tblr -->
            </div><!-- mtb-50 -->            
            <div class="mtb-50 mb-md-0">
                <h4 class="p-title"><b>NEWSLETTER</b></h4>
                <p class="mb-20">Subscribe to our newsletter to get notification about new updates,
                information, discount, etc..</p>
                <form @submit.prevent="newsLetter()" class="nwsltr-primary-1 newsletter">
                    <input type="text" v-model="newsletter_email" placeholder="Your email">
                    <button type="submit"><i class="ion-ios-paperplane"></i></button>
                </form>
            </div><!-- mtb-50 -->            
            </div><!--  pl-20 -->
        </div><!-- col-md-3 --> 
</template>
<script>
export default {
    name : 'postsidebar',
    data : function(){
        return {
           top4Blog :[],
           newsletter_email:'' 
        }           
    },
    methods:{  
        top4BlogSideBar(){
            let _this = this; 
            this.$store.dispatch('top4BlogSideBar')
            .then(function(data){  
                _this.top4Blog = data.data;
            }); 
        },
        newsLetter(){
           this.$toastr.s('You have subscribed successfully','News Letter Subscription Alert!!');
        } 
    },
    created(){
        this.top4BlogSideBar();          
    }
}
</script>
<style scoped>
  .bg-primary {
        background: #88857a!important;
        color: #fff;
   }
   .text-center {
        text-align: left !important;
        padding-left: 17px;
    }

</style>