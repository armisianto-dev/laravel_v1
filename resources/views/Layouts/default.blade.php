<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel V1</title>
  <!--STYLESHEET-->
  <!--=================================================-->
  <link href="{{ URL::asset('assets/themes/default/load-style.css') }}" rel='stylesheet' type='text/css'>
  {{-- <link rel="shortcut icon" href="../doc/images/favicon.ico" /> --}}

  <!--Morris.js [ OPTIONAL ]-->
  <link href="{{ URL::asset('assets/themes/default/plugins/morris-js/morris.min.css') }}" rel="stylesheet">
  <!--Magic Checkbox [ OPTIONAL ]-->
  <link href="{{ URL::asset('assets/themes/default/plugins/magic-check/css/magic-check.min.css') }}" rel="stylesheet">

  <!--JAVASCRIPT-->
  <!--=================================================-->
  <!--Pace - Page Load Progress Par [OPTIONAL]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/pace/pace.min.js') }}"></script>
  <!--jQuery [ REQUIRED ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/js/jquery-2.2.4.min.js') }}"></script>
  <!--BootstrapJS [ RECOMMENDED ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/js/bootstrap.min.js') }}"></script>
  <!--NiftyJS [ RECOMMENDED ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/js/nifty.js') }}"></script>

  <!--=================================================-->
  <!--Demo script [ DEMONSTRATION ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/js/demo/nifty-demo.min.js') }}"></script>

  <!--Morris.js [ OPTIONAL ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/morris-js/morris.min.js') }}"></script>
  <script src="{{ URL::asset('assets/themes/default/plugins/morris-js/raphael-js/raphael.min.js') }}"></script>

  <!--Sparkline [ OPTIONAL ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

  <!--Specify page [ SAMPLE ]-->
  <script src="{{ URL::asset('assets/themes/default/plugins/js/demo/dashboard.js') }}"></script>
</head>

<body>
  <div id="container" class="effect aside-float aside-bright mainnav-lg navbar-fixed">

    @include('includes.default.header')

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        @yield('content')
      </div>
      <!--END OF CONTENT CONTAINER-->
      <!--===================================================-->

      @include('includes.default.sidebar_nav');

    </div>

    <!-- FOOTER -->
    <!--===================================================-->
    <footer id="footer">

      <!-- Visible when footer positions are static -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <div class="hide-fixed pull-right pad-rgt">
        <strong>PT. Time Excelindo</strong>
      </div>

      <p class="pad-lft">&#0169;</p>



    </footer>
    <!--===================================================-->
    <!-- END FOOTER -->


    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn">
      <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->

  </div>
</body>

</html>
