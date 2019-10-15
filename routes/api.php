<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});   

//Only Auth User Allowed Route
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', 'AuthController@logout');

    Route::get('/dashboard', 'AuthController@dashboard');   
  
    //Admin section blogs route        
    Route::resource('blogs', 'BlogsController'); 
    Route::post('blogs/update', 'BlogsController@update'); 

     //Admin section blogs Category route   
    Route::resource('categories', 'BlogCategory'); 
    Route::post('blcategoriesogs/update', 'BlogCategory@update'); 
             
     //Admin section users route   
    Route::resource('users', 'UserController'); 
    Route::post('users/update', 'UserController@update');
    Route::post('users/changeStatus', 'UserController@changeStatus');  
    
     //Admin section user profile route   
    Route::get('/user/profile', 'UserController@profile');
    Route::post('/user/profileUpdate', 'UserController@profileUpdate'); 
});
 
 

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('verifyAccount', 'AuthController@verifyAccount');
Route::post('verifySubmitAccount', 'AuthController@verifySubmitAccount'); 
Route::post('verifyResendCode', 'AuthController@verifyResendCode');

Route::post('/forgotPasswordCodeSend','AuthController@forgotPasswordCodeSend');
Route::post('/forgotPasswordCodeVerify','AuthController@forgotPasswordCodeVerify');
Route::post('/sendEmailfun','AuthController@sendEmailfun');

//Front All Blog List
Route::get('/catList','FrontController@categories');
Route::get('/top4Blog','FrontController@top4Blog');
Route::get('/top2FootLeft','FrontController@top2FootLeft');
Route::get('/top2FootRight','FrontController@top2FootRight');
Route::post('/homeRecentBlogs','FrontController@homeRecentBlogs');
Route::get('/homeTopBlogs','FrontController@homeTopBlogs');
Route::get('/singleBlog/{url}','FrontController@singleBlog');
Route::post('/blogsByCategory/{cname}','FrontController@blogsByCategory');
Route::get('/singleSimilarPost/{cname}','FrontController@singleSimilarPost');
Route::get('/contactDetail','FrontController@contactDetail');
Route::post('/contactDetailSave','ContactUs@contactDetailSave');
Route::post('/blogsByFilter','FrontController@blogsByFilter');








