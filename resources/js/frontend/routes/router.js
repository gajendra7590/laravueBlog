import Vue from 'vue';
import VueRouter from 'vue-router';  
import blogHome from '../components/BlogHome';
import BlogCat from '../components/BlogCat';
import BlogFilter from '../components/BlogFilter';
import BlogSingle from '../components/BlogSingle';
import ContactUs from '../components/ContactUs';
import AboutUs from '../components/AboutUs';
import Faq from '../components/Faq';  

Vue.use(VueRouter); 
  
const router = new VueRouter({
    mode: 'history',
    routes: [ 
      { path: '/',name: 'home',component: blogHome }, 
      { path: '/cat/:caturl',name: 'categoryBlogs',component: BlogCat },
      { path: '/s/:blogurl',name: 'singleBlogs',component: BlogSingle }, 
      { path: '/search/blog',name: 'searchKeywork',component: BlogFilter },
      { path: '/contact-us',name: 'contact-us',component: ContactUs },
      { path: '/about-us',name: 'about-us',component: AboutUs },
      { path: '/faq',name: 'faq',component: Faq },
      { path: '*', redirect:'/'}    ]
  }); 

export default router;
