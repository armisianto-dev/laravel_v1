@extends('layouts.default-login')
@section('content')
<div id="container" class="cls-container">
  <!-- BACKGROUND IMAGE -->
  <!--===================================================-->
  <div id="bg-overlay" class="bg-img" style="background-image: url({{ URL::asset('assets/themes/default/img/background-login.jpeg') }});"></div>
  <div class="cls-content">
    <div class="cls-content-sm panel">
      <div class="panel-body">
        <div class="mar-ver pad-btm">
          <img src="{{ URL::asset('assets/themes/default/img/laravel-logo.png') }}" alt="E-Koperasi" style="max-width:72px" />
          <h3 class="h4 mar-top">Laravel</h3>
        </div>

        @if ($message = Session::get('error'))

        <div class="alert alert-danger alert-block">

          <button type="button" class="close" data-dismiss="alert">×</button>

          <strong class="text-left">{{ $message }}</strong>
          @if (count($errors) > 0)
          <ul class="text-left">
            @foreach ($errors->all() as $error)
            <li class="text-left">{{ $error }}</li>
            @endforeach
          </ul>
          @endif

        </div>

        @endif

        <form class="form-horizontal mar-top" action="/auth/developer/authenticating" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <div class="col-md-12">
              <input type="text" name="username" class="form-control" placeholder="Username/E-Mail" autofocus>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
          </div>
          <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
        </form>
      </div>

      <div class="pad-all">
        <a href="#" class="btn-link mar-rgt">Lupa password ?</a>
      </div>
    </div>
  </div>
</div>
@endsection
