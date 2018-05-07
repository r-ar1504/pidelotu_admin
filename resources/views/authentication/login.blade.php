<!DOCTYPE html>
<html lang="es-419">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Pídelo Tu | Dashboard</title>

  <link rel="icon" href="images/favicon.png">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('stylesheets')
</head>

<body>
  <div class="main-container">

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</body>
  @yield('javascript')

</html>
