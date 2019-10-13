<template>
    <div id="wrapper">  
            <sidebarc></sidebarc>
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column"> 
                 <!-- Main Content -->
                 <div id="content">
                      <headerc></headerc>
                      <!-- Begin Page Content -->
                        <div class="container-fluid"> 
                              <!-- Main html content load according to route -->
                              <router-view></router-view>
                        </div>
                        <!-- /.container-fluid -->
                 </div> 
                <footerc></footerc>
            </div>    
    </div>
  <!-- End of Page Wrapper --> 
</template>
<script>  
    import Head  from './admin/components/common/Header';
    import Sidebar  from './admin/components/common/Sidebar';
    import Footer  from './admin/components/common/Footer';
    export default {
        components:{
            'headerc':Head,
            'sidebarc':Sidebar,
            'footerc':Footer
        },
        name:'appcomponent',
        data : function(){
            return {

            } 
        }
    }
</script>
<style> 
</style>
