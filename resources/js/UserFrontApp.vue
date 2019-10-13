<template>
    <div class="main-section">   
        <headerc ></headerc>  
           <router-view></router-view>
        <footerc ></footerc> 
    </div>
  <!-- End of Page Wrapper --> 
</template>
<script>   
    import Header  from './frontend/components/common/Header'; 
    import Footer  from './frontend/components/common/Footer'; 
    export default {
        components:{
            'headerc':Header, 
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
