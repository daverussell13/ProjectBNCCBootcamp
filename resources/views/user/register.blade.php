<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
  <style>
    .error {
      font-size: .9em;
    }
  </style>
</head>
@if (Session::get('Success'))
  <div id="success-alert" class="alert alert-success">
    {{ Session::get('Success') }}
  </div>
@elseif (Session::get('Failed'))
  <div id="danger-alert" class="alert alert-danger">
    {{ Session::get('Failed') }}
  </div>
@endif

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>PT </b>MAKMUR JAYA</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new account</p>

        <form action="{{ route('user.register') }}" method="post">

          @csrf

          <div class="input-group">
            <input type="text" class="form-control" placeholder="Full name" name="name"
              value="{{ old('name') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="text-danger mb-3 error">
            @error('name')
              {{ $message }}
            @enderror
          </div>

          <div class="input-group">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
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
            <input type="tel" class="form-control" placeholder="Phone number" name="phone"
              value="{{ old('phone') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="text-danger mb-3 error">
            @error('phone')
              {{ $message }}
            @enderror
          </div>

          <div class="input-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
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

          <div class="input-group">
            <input type="password" class="form-control" placeholder="Retype password" name="cpassword">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="text-danger mb-3 error">
            @error('cpassword')
              {{ $message }}
            @enderror
          </div>

          <a href="{{ route('user.login') }}" class="text-center">I already have an account</a>
          <div class="row">
            <div class="col-8"></div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

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

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  </script>
</body>

</html>
