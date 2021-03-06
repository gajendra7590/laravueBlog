<!DOCTYPE html>
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="">

  <title>LaraVue Demo</title>

  <!-- Custom fonts for this template-->
  <link href="{{ URL::asset('adminjscss/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> 
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('adminjscss/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head> 
    <body class="bg-gradient-primary"> 
            <div class="container">  
                <div id="app"> 
                    @yield('content') 
                </div> 
            </div>

          <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script> 

          <!-- Bootstrap core JavaScript-->
          <script type="text/javascript" src="{{ URL::asset('adminjscss/vendor/jquery/jquery.min.js') }}"></script>
          <script type="text/javascript" src="{{ URL::asset('adminjscss/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        
          <!-- Core plugin JavaScript-->
          <script type="text/javascript" src="{{ URL::asset('adminjscss/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        
          <!-- Custom scripts for all pages-->
          <script type="text/javascript" src="{{ URL::asset('adminjscss/js/sb-admin-2.min.js') }}"></script> 
    </body> 
</html>
