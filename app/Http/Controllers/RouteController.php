<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{

    public function mainRoute(Request $request){
        return view('frontend.mainFront');        
    } 


    public function frontRoute(Request $request){
        return view('admin.adminFront');        
    } 

    public function verifyAccount(Request $request,$code){
        return view('admin.adminFront');        
    }  
    
    public function adminRoute(){
        return view('admin.main');    
    } 
    
}
