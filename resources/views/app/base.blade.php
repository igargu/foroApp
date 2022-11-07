<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
      <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
      <title>foroApp</title>
      <!-- CSS Propio -->
      <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
      <!-- Fonts and icons -->
      <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" rel="stylesheet" />
      <!-- Nucleo Icons -->
      <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
      <!-- Font Awesome Icons -->
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />  
      <!-- CSS Files -->
      <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet" />
    </head>
    <body class="g-sidenav-show bg-gray-100">
      <!-- CONTENIDO DE CABECERA -->
      @yield('content')
      <!-- Core JS Files -->
      <script type="text/javascript" src="{{ asset('assets/js/core/popper.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    
      <!-- Plugin for the charts, full documentation here: https://www.chartjs.org/ -->
      <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>
    
      <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
      <script type="text/javascript" src="{{ asset('assets/js/material-dashboard.min.js') }}"></script>
    </body>
</html>