<template>
    <div id="headc">
         <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> 
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button> 
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto"> 
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> 
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ userName }}</span>
                <img class="img-profile rounded-circle" :src="`/images/${(profileLogo)?profileLogo:'/default/user_default.png'}`">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <router-link class="dropdown-item" to="/admin/profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </router-link>  
                <router-link class="dropdown-item" to="/admin/logout" data-toggle="modal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </router-link>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
    </div>
</template>
<script>
    export default {
        name : "headc",
        data : function(){
          return {
            userName : null,
            profileLogo : null
          }
        },
        methods:{ 

          getProfile(){
            let _this = this;
            this.$store.dispatch('userProfile')
              .then(function(data){  
                // console.log(data.result.data)
                _this.$store.state.getProfile = data.result.data; 
                _this.userName =  data.result.data.name;
                _this.profileLogo = (data.result.data.image)?data.result.data.image:'';
              });
          } 

        },
        created(){
          this.getProfile();
        }
        
    }
</script>
<style scoped>
  span.mr-2.d-none.d-lg-inline.text-gray-600.small {
      text-transform: capitalize;
      font-size: 16px;
  } 
</style>