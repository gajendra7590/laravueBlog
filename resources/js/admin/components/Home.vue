<template>
    <div id="homec"> 
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
       </div>
       <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Register users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ widget.allUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Active Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ widget.activeUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Inactive Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ widget.inactiveUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total events</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ widget.allEvents }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
            
          </div>
    </div>
</template>
<script>
    export default {
        name : "homec",
        data : function(){
          return {
            widget : []
          }
        },
        methods:{
          getvisits(){
             let _this = this;
             this.$store.dispatch('userDashboard',{}) 
             .then(function(data){
                   if( typeof(data.status)!='undefined' && data.status == true){ 
                     _this.widget = data.response;                      
                   }else if( typeof(data.status)!='undefined' && data.status == false){
                      _this.$toastr.e(data.message,'Warning!') 
                   }else{
                      _this.$toastr.e('Something went wrong','Invalid')
                  }
             });
          }
        },
        created(){
          this.getvisits();
        } 
    }
</script>