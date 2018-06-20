<!DOCTYPE html>
<html lang="es-419">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Pídelo Tu | Panel</title>

  <link rel="icon" href="images/favicon.png">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/ic.png')}}"/>
  @yield('stylesheets')
</head>

<body>

  <header class="panel-header">

    <img src="{{ asset('images/logo.png') }}" alt="pidelotu_logo" id="app-logo">
    <h1 id="header-title"> @yield('section-title') </h1>
    <img src="{{ asset('images/notification-bell.png') }}" alt="notify-bell">

  </header><!-- Header End-->

  <div class="main-container">
    <div class="left-panel-section">
      <div id="button-container">
        <div class="left-panel-element" id="restaurantActive">
          <img src="{{ asset('images/restaurant.png') }}" alt="restaurant" id="restaurant">
          <p>PLATILLOS</p>
        </div>
        <form action="/restaurante/ordenes" method="get">
          <button type="submit" class="left-panel-element" style="background-color: transparent; border: 1px solid transparent; width: 100%; cursor: pointer;">
            <img src="{{ asset('images/pedidos.png') }}" alt="pedidos" id="pedidos">
            <p>PEDIDOS</p>
            <input type="" name="id" hidden value="@yield('section-title')">
          </button>
        </form>
        <form action="/restaurante/cerrar" method="post">
          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <button type="submit" class="left-panel-element" style="background-color: transparent; border: 1px solid transparent; width: 100%; cursor: pointer;">
            <img src="{{ asset('images/tiempo.png') }}" alt="pedidos" id="pedidos">
            <p>@yield('status')</p>
            <input type="" name="id" hidden value="@yield('section-title')">
            <input type="" name="status" hidden value="@yield('status')">
          </button>
        </form>
      </div><!--End of Button Holder-->

      <div id="logout-container" style="margin-left: 8px;">
        <button id="logout" type="submit" name="button" style="cursor: pointer;">Cerrar Sesión</button>
      </div>
    </div><!--End Left Panel-->

    <div class="right-panel-section">
      @yield('content')
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
    $(function(){
      $("body").on('click', '#restaurantActive', function(){
        window.location.href = '/restaurante/inicio/'+localStorage.getItem("user");
      });

      $("body").on('click', '#pedidosActive', function(){
        window.location.href = '/restaurante/ordenes';
      });

      $("body").on('click', '#logout', function(){
        localStorage.removeItem('user')
        window.location.href = '/logout';
      });
    });
  </script>
</body>
  @yield('javascript')

</html>
