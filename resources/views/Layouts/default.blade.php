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

      <!--MAIN NAVIGATION-->
      <!--===================================================-->
      <nav id="mainnav-container">
        <div id="mainnav">

          <!--Menu-->
          <!--================================-->
          <div id="mainnav-menu-wrap">
            <div class="nano">
              <div class="nano-content">

                <!--Profile Widget-->
                <!--================================-->
                <div id="mainnav-profile" class="mainnav-profile">
                  <div class="profile-wrap">
                    <div class="pad-btm">
                      <span class="label label-success pull-right">New</span>
                      <img class="img-circle img-sm img-border" src="{{ URL::asset('assets/images/IMG_9529_white.jpg') }}"
                      alt="Profile Picture">
                    </div>
                    <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                      <span class="pull-right dropdown-toggle">
                        <i class="dropdown-caret"></i>
                      </span>
                      <p class="mnp-name">Armisianto</p>
                      <span class="mnp-desc">armisianto@gmail.com</span>
                    </a>
                  </div>
                  <div id="profile-nav" class="collapse list-group bg-trans">
                    <a href="#" class="list-group-item">
                      <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                    </a>
                    <a href="#" class="list-group-item">
                      <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                    </a>
                    <a href="#" class="list-group-item">
                      <i class="demo-pli-information icon-lg icon-fw"></i> Help
                    </a>
                    <a href="/auth/developer/logout" class="list-group-item">
                      <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                    </a>
                  </div>
                </div>


                <!--Shortcut buttons-->
                <!--================================-->
                <div id="mainnav-shortcut">
                  <ul class="list-unstyled">
                    <li class="col-xs-3" data-content="My Profile">
                      <a class="shortcut-grid" href="#">
                        <i class="demo-psi-male"></i>
                      </a>
                    </li>
                    <li class="col-xs-3" data-content="Messages">
                      <a class="shortcut-grid" href="#">
                        <i class="demo-psi-speech-bubble-3"></i>
                      </a>
                    </li>
                    <li class="col-xs-3" data-content="Activity">
                      <a class="shortcut-grid" href="#">
                        <i class="demo-psi-thunder"></i>
                      </a>
                    </li>
                    <li class="col-xs-3" data-content="Lock Screen">
                      <a class="shortcut-grid" href="#">
                        <i class="demo-psi-lock-2"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <!--================================-->
                <!--End shortcut buttons-->


                <ul id="mainnav-menu" class="list-group">

                  @include('includes.default.sidebar_nav');


                </ul>
              </div>
            </div>
            <!--================================-->
            <!--End widget-->

          </div>
        </div>
        <!--================================-->
        <!--End menu-->
      </nav>
      <!--===================================================-->
      <!--END MAIN NAVIGATION-->

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
