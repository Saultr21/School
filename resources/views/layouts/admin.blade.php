<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
  <title>@yield('title', 'Admin - Online Store')</title>
</head>

<body>
  <div class="row g-0">
    <!-- sidebar -->
    <div class="p-3 col fixed text-white bg-dark">
      <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none">
        <span class="fs-4">Panel de control</span>
      </a>
      <hr />
      <ul class="nav flex-column">
        <li><a href="{{ route('admin.home.index') }}" class="nav-link text-white">- Página principal de la administración</a></li>
        <li><a href="{{ route('admin.product.index') }}" class="nav-link text-white">- Administración de productos</a></li>
        <li>
          <a href="{{ route('home.index') }}" class="mt-2 btn bg-primary text-white">Volver a la página principal</a>
        </li>
      </ul>
    </div>
    <!-- sidebar -->
    <div class="col content-grey">
      <nav class="p-3 shadow text-end">
        <span class="profile-font">Admin</span>
        <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}">
      </nav>

      <div class="g-0 m-3">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- footer -->
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>
        Pie de página
      </small>
    </div>
  </div>
  <!-- footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
</body>

</html>
