<template>
    <div id="sidebarc">
            <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"> 
      <!-- Sidebar - Brand -->
      <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="admin/home">            
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">VueLaraDemo</div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0"> 
     
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></router-link>
      </li>

      <!-- Nav Item - Events -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/blogs">
          <i class="fa fa-comment"></i>
          <span>Blogs List</span></router-link>
      </li> 

      <!-- Nav Item - Events -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/blog-category">
          <i class="fa fa-comment"></i>
          <span>Blog Categories</span></router-link>
      </li>

      <!-- Nav Item - Users -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/users">
          <i class="fas fa-fw fa-users"></i>
          <span>Users List</span></router-link>
      </li> 

      <!-- Nav Item - Profile -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/profile">
          <i class="fas fa-fw fa-user"></i>
          <span>Profile</span></router-link>
      </li> 

    </ul>
    <!-- End of Sidebar -->
    </div>
</template>
<script>
    export default {
        name : "sidebarc"
        
    }
</script>