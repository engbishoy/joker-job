<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  
  @if ( Config::get('app.locale') == 'en')
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">

  @else
  
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/fonts-fa.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/bootstrap-rtl.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/rtl.css')}}">

  @endif
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">




<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
  
      <form action="{{route('admin.login')}}" method="post">
        @csrf
        <div class="form-group has-feedback">
          <input type="text" name="identify" class="form-control @error('identify') is-invalid @enderror" placeholder="Email Or Password">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @error('identify')
          <span class="invalid-feedback" role="alert">
            <strong style="color:red;font-weight: bold">{{ $message }}</strong>
        </span>
          @enderror
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
          <span class="invalid-feedback" role="alert">
              <strong style="color:red;font-weight: bold">{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
  
      <a href="#">I forgot my password</a><br>
  
    </div>
    <!-- /.login-box-body -->
  </div>







  
<!-- /.login-box -->

<!-- jQuery 3 -->
<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

</body>
</html>
