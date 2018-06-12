<!DOCTYPE html>
<html lang="es-419">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Pídelo Tu | Panel</title>

  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" href="images/favicon.png">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/ic.png')}}"/>
  @yield('stylesheets')
</head>

<body>
  <header class="panel-header">
    <img src="{{ asset('images/logo.png') }}" alt="pidelotu_logo" id="app-logo">
    <h1 align="center" id="header-title"> @yield('section-title') </h1>
    <img src="{{ asset('images/notification-bell.png') }}" alt="notify-bell">
  </header><!-- Header End-->

  <div class="main-container">
    <div class="left-panel-section">
      <div id="button-container">
        <div class="left-panel-element" id="restaurantActive">
          <img src="{{ asset('images/restaurant.png') }}" alt="restaurant" id="restaurant">
          <p>RESTAURANTES</p>
        </div>
        <div class="left-panel-element" id="pedidosActive">
          <img src="{{ asset('images/pedidos.png') }}" alt="pedidos" id="pedidos">
          <p>REPARTIDORES</p>
        </div>
        <!--<div class="left-panel-element">
          <img src="{{ asset('images/analysis.png') }}" alt="analysis" id="analysis">
          <p>ANÁLISIS GENERAL</p>
        </div>-->
      </div><!--End of Button Holder-->

      <div id="logout-container" style="margin-left: 8px;">
        <form action="/logout" method="get">
          <button type="submit" name="button">Cerrar Sesión</button>
        </form>
      </div>
    </div><!--End Left Panel-->

    <div class="right-panel-section">
      @yield('content')
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="/js/layouts/admin-app-header.js"></script>
</body>
  @yield('javascript')
</html>
