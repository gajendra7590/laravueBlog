<?php 

if (! function_exists('errorArrayCreate')) {
    function errorArrayCreate($obj) {
        try{
            $obj = $obj->toArray();
            $errors = array();
            if( is_array($obj) && !empty($obj)){
               foreach($obj as $k => $v){
                   if( count($v) > 1 ){
                       $err = '';
                       foreach ($v as $value) {
                         $err.= $value.' && '; 
                       }  
                       trim($err,'&&');
                       $errors[$k] = $err;
                   }else{
                       $errors[$k] = $v[0];
                   }
                   
               } 
            } 
            return $errors;
        }
        catch(\Exception $e){
            throw $e; 
        } 
    }
}


