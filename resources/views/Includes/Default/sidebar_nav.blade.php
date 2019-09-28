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
                <img class="img-circle img-sm img-border" src="{{ URL::asset($com_user['user_image']) }}"
                alt="Profile Picture">
              </div>
              <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                <span class="pull-right dropdown-toggle">
                  <i class="dropdown-caret"></i>
                </span>
                <p class="mnp-name">{{ $com_user['user_alias'] }}</p>
                <span class="mnp-desc">{{ $com_user['user_mail'] }}</span>
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

            {!! $list_nav !!}


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
