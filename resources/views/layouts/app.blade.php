<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="@yield('meta_keywords')">
  <meta name="description" content="@yield('meta_desc')">
  <link rel="apple-touch-icon" sizes="76x76" href="/frontend/img//apple-icon.png">
  <link rel="icon" type="image/png" href="/frontend/img//favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Senior Step | @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/frontend/css/paper-kit.css?v=2.2.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('/frontend/demo/demo.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/prism.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.21.0/prism.min.js" integrity="sha512-WkVkkoB31AoI9DAk6SEEEyacH9etQXKUov4JRRuM1Y681VsTq7jYgrRw06cbP6Io7kPsKx+tLFpH/HXZSZ2YEQ==" crossorigin="anonymous"></script>
  @stack('css')
  @livewireStyles
</head>

<body class="index-page sidebar-collapse">
  <!-- Navbar -->
  @include('layouts.nav')
  <!-- End Navbar -->
  @yield('background-image')
  <div class="main">
  @yield('content')
  </div>
  @if(!isset($non_footer))
    @include('layouts.footer')
  @endif
    <!--   Core JS Files   -->
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <script src="{{ asset('/frontend/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/frontend/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/frontend/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/6.1.1/d3.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('/frontend/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('/frontend/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="{{ asset('/frontend/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/frontend/js/paper-kit.js?v=2.2.0') }}" type="text/javascript"></script>
    <!-- My Js File -->
    <script src="{{ asset('/js/main.js') }}"></script>  
    <script>
      $(document).ready(function() {
        if ($("#datetimepicker").length != 0) {
          $('#datetimepicker').datetimepicker({
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
        }

        function scrollToDownload() {

          if ($('.section-download').length != 0) {
            $("html, body").animate({
              scrollTop: $('.section-download').offset().top
            }, 1000);
          }
        }
      });
    </script> 
    @stack('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
    @if (Session::has('sweet_alert.alert'))
        <script>
            swal({!! Session::get('sweet_alert.alert') !!});
        </script>
        {{ Session::forget('sweet_alert.alert') }}    
    @endif
    @livewireScripts
</body>

</html>