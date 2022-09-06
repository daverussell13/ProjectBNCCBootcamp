<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PT Makmur Jaya</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('/') }}css/album.css" rel="stylesheet">
  <!-- Sweet alert -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  @yield('meta')

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">PT Makmur Jaya</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item @if (Route::is('user.home')) active @endif">
            <a class="nav-link" href="{{ route('user.home') }}">Katalog</a>
          </li>
          <li class="nav-item @if (Route::is('user.faktur')) active @endif">
            <a class="nav-link" href="{{ route('user.faktur') }}">Faktur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="cursor: pointer"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form action="{{ route('user.logout') }}" id="logout-form" class="d-none" method="post">@csrf</form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main role="main">

    @yield('content')

  </main>

  <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
  <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}plugins/holder/js/holder.min.js"></script>
  <!-- Sweet alert -->
  <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

  @yield('scripts')

</body>

</html>
