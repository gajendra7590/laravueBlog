<!DOCTYPE html>
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="">

  <title>LaraVue blog</title>

  <!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">	
  <!-- <link href="{{ URL::asset('frontend/font/font.css') }}" rel="stylesheet">	 -->
	<!-- Stylesheets -->	
	<link href="{{ URL::asset('frontend/plugin-frameworks/bootstrap.css') }}" rel="stylesheet">	
	<link href="{{ URL::asset('frontend/fonts/ionicons.css') }}" rel="stylesheet"> 		
  <link href="{{ URL::asset('frontend/common/styles.css') }}" rel="stylesheet">
  
</head> 
    <body>   
          <div id="app"> 
             @yield('content') 
          </div> 
          <script type="text/javascript" src="{{ URL::asset('js/appFront.js') }}"></script> 
          <script type="text/javascript" src="{{ URL::asset('/frontend/plugin-frameworks/jquery-3.2.1.min.js') }}"></script>	
          <script type="text/javascript" src="{{ URL::asset('/frontend/plugin-frameworks/tether.min.js') }}"></script>          
          <script type="text/javascript" src="{{ URL::asset('/frontend/plugin-frameworks/bootstrap.js') }}"></script>          
          <script type="text/javascript" src="{{ URL::asset('/frontend/common/scripts.js') }}"></script>          
    </body> 
</html>
