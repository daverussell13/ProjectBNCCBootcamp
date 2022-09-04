<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

  @if (Session::get('Fail'))
    <div id="danger-alert" class="alert alert-danger">
      Error : {{ Session::get('Fail') }}
    </div>
  @endif

  <div class="login-box user-select-none">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>PT </b>MAKMUR JAYA</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ $loginRoute }}" method="post">

          @csrf

          <div class="input-group">
            @yield('input-id')
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="text-danger mb-3 error">
            @error('email')
              {{ $message }}
            @enderror
          </div>

          <div class="input-group">
            <input type="password" class="form-control" placeholder="Password" name="password"
              value="{{ old('password') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="text-danger mb-3 error">
            @error('password')
              {{ $message }}
            @enderror
          </div>

          @yield('admin-user')

          @if ($loginRoute == '/user/login')
            <p class="mb-0">
              <a href="{{ route('user.register') }}" class="text-center">Register a new membership</a>
            </p>
          @endif

          <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>

  <script>
    $("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  </script>
</body>

</html>
