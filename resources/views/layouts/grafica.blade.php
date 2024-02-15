<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

  <!-- Incluimos un fichero CSS personalizado creado por nosotros -->
  <!-- Usamos para ello el helper "asset", que genera la URL completa que apunta al fichero pasado por parámetro -->
  <!-- Usamos las llaves dobles para invocal un helper -->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

  <!-- Marcador donde incluiremos el título de la página. El primer parámetro (title) contiene el identificador y el segundo (Tienda online) contiene el valor por defecto que se usará en caso de que no se le asigne ningún valor al marcador-->
  <title>@yield('title', 'Tienda online')</title>   
  @yield('scripts')
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admin.home.index') }}">Panel de control</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('grafica1') }}">Gráfica 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('grafica2') }}">Gráfica 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('grafica3') }}">Gráfica 3</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('grafica4') }}">Gráfica 4</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header>
      <h1>@yield('title')</h1>
      <h2>@yield('subtitle')</h2>
  </header>

  <main>
      <div class="chart-container">
@yield('content')
      </div>
  </main>
</body>

</html>