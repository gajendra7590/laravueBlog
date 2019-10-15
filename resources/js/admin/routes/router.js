import Vue from 'vue';
import VueRouter from 'vue-router'; 
import Adminhome from '../components/Home.vue'
import Blogs from '../components/Blogs.vue'
import BlogCategory from '../components/BlogCategory'
import Profile from '../components/Profile.vue'
import Logout from '../components/Logout.vue'
import Users from '../components/Users.vue'

import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import ForgotPassword from '../components/ForgotPassword.vue';
import VerifyAccount from '../components/VerifyAccount.vue';
import ResendVerificationCode from '../components/ResendVerificationCode.vue';


Vue.use(VueRouter); 
  
const router = new VueRouter({
    mode: 'history',
    routes: [
      { path: '/admin',redirect:'/admin/home'},
      { path: '/admin/home',name: 'user',component: Adminhome,meta: { requiresAuth: true } },
      { path: '/admin/blogs',name: 'blogs',component: Blogs,meta: { requiresAuth: true } },
      { path: '/admin/blog-category',name: 'blog-category',component: BlogCategory,meta: { requiresAuth: true,permission: 'admin' } },
      { path: '/admin/profile',name: 'profile',component: Profile,meta: { requiresAuth: true } },
      { path: '/admin/logout', name: 'logout', component: Logout,meta: { requiresAuth: true }  },
      { path: '/admin/users', name: 'users',component: Users,meta: { requiresAuth: true } }, 
      { path: '/login', name: 'login',component: Login,meta: { requiresVisitor: true } },
      { path: '/register', name: 'register',component: Register,meta: { requiresVisitor: true } },
      { path: '/verify-account/:getVcode', name: 'verify-account',component: VerifyAccount },
      { path: '/resendVerifyCode', name: 'resendVerifyCode',component: ResendVerificationCode },
      { path: '/forgot-password', name: 'forgot-password',component: ForgotPassword }, 
      { path: '*', redirect:'/admin/home',meta: { requiresAuth: true } },
    ]
  }); 

  router.beforeResolve((to, from, next) => {    
    if (to.matched.some(record => record.meta.requiresAuth)) {  
      if (!(!!localStorage.getItem('token'))) {
        window.location.href = '/login';
      } else { 
        next()
      }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {  
      if ((!!localStorage.getItem('token'))) { 
        window.location.href = '/admin/home';
      } else {
         next()
      }
    }
    else {
      next() // make sure to always call next()!
    }
  }) 

export default router;
