<?php 


Route::get('/login', 'RouteController@frontRoute');  
Route::get('/register', 'RouteController@frontRoute');  
Route::get('/verify-account/{verifyCode}', 'RouteController@frontRoute'); 
Route::get('/resendVerifyCode', 'RouteController@frontRoute');
Route::get('/forgot-password', 'RouteController@frontRoute');


//For Admin Routes
Route::group(['prefix'=>'admin','as'=>'admin.'], function() {
    Route::get('/', 'RouteController@adminRoute')->where('any', '.*');
    Route::get('/{any}', 'RouteController@adminRoute')->where('any', '.*');  
});

//For Front Route
Route::get('/', 'RouteController@mainRoute')->where('any', '.*');
Route::get('/{any}', 'RouteController@mainRoute')->where('any', '.*');  
 