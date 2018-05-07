<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Pídelo Tu</title>

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="icon" href="images/favicon.png">
</head>

<body>
  <header>
    <div id="header-container">
      <img src="{{ asset('images/icons/logo.png') }}" alt="pidelotu_logo" id="header-logo-normal">
      <div id="header-link">
        <button type="button" name="button">Registro</button>
      </div>
    </div>
  </header>
  <div id="main-container">
    <div id="banner-section"><!--SOS-->
      <div id="banner-info">
        <h1>Ordena lo que mas te gusta sin tener que moverte de donde estás</h1>
        <p>Con  <strong><span>Pídelo</span><span>Tú</span></strong>  ordenar comida nunca fue tan sencillo.</p>
      </div>
      <div id="banner-image">
        <img src="{{ asset('images/icons/banner-preview.png') }}" alt="preview-app" id="preview-img" id="prew">
      </div>
    </div><!--EOS-->
    <div id="preview-section"><!--SOS-->
      <div class="preview-text">
        <h1>No te quedes sin opciones con +65 restaurantes para ordenar</h1>
        <ul>
          <li> <i class="fa fa fa-lock"></i><p>Rapido y seguro</p> </li>
          <li> <i class="fa fa fa-cutlery"></i><p>Encuentra tus platillos favoritos</p> </li>
          <li> <i class="fa fa fa-credit-card"></i><p>Pago desde la aplicación</p> </li>
        </ul>
      </div>
      <div id="iphone-preview">
        <div id="screens-container">
          <img src="http://via.placeholder.com/305x658" alt="preview-app" id="preview-img" class="screenshot">
          <img src="http://via.placeholder.com/305x658" alt="preview-app" id="preview-img" class="screenshot">
          <img src="http://via.placeholder.com/305x658" alt="preview-app" id="preview-img" class="screenshot">
          <img src="http://via.placeholder.com/305x658" alt="preview-app" id="preview-img" class="screenshot">
          <img src="http://via.placeholder.com/305x658" alt="preview-app" id="preview-img" class="screenshot">
        </div>
        <img src="{{ asset('images/iphone-mk.png')}}" alt="iphone-muckup" id="iphone-mk">
      </div>
      <div class="preview-text">

      </div>
    </div><!--EOS-->
    <div id="stores-section"><!--SOS-->
      <div class="overlay">
        <h1>¡ Descarga Pídelo<span>Tú</span> !</h1>
        <div id="store-icons">
          <img src="{{ asset('images/google.png') }}" alt="google-icon" class="store-icon">
          <img src="{{ asset('images/ios.png') }}" alt="ios-icon" class="store-icon">
        </div>
      </div>
    </div><!--EOS-->
    <div id="footer-section"><!--SOS-->
      <div ="">

      </div>
    </div><!--EOS-->
</div>
</body>

</html>
