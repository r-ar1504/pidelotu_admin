<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  <meta name="copyright" content="Supernova Apps">
  <meta name="url" content="{{ env('APP_URL') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="Title" content="Pídelo Tú">
  <meta name="theme-color" content="#4267b2">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="keywords" content="Pídelo Tú, comida, ordena, te gusta, sencillo, restaurantes, ordenar, rapido, seguro, platillos, favoritos, pago desde la aplicaión,"/>
  <meta name="description" content="Ordena lo que mas te gusta sin tener que moverte de donde estás"/>

  <!-- Add company logo -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/ic.png')}}"/>
  <title>Pídelo Tú</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{elixir('css/jquery-ui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{elixir('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{elixir('css/Animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{elixir('libs/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #4267b2">
	  <a href="/"><img src="{{ asset('images/logo-white.png') }}" alt="pidelo-tu_logo" id="header-logo-normal"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	  	<div class="input-group">
		    <div class="input-group-prepend">
		      <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
		    </div>
		    <input type="text" class="form-control" placeholder="Busca tú comida favorita aquí" aria-label="Busca tú comida favorita aquí" aria-describedby="basic-addon1">
		  </div>
	  	<div class="col-md-6">
	  		<form class="form-inline my-2 my-lg-0">
		      <ul class="navbar-nav mr-auto">
		      	<li class="nav-item btn">
		      		<button class="btn btn-success my-2 my-sm-0 btn-re" type="submit">
				  			<i class="fa fa-search"></i>
				  		</button>
		      	</li>
			      <li class="nav-item">
			        <a class="nav-link l" href="/login">Iniciar Sesión</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link l" href="/unete-a-nosotros">Registrarse</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link l" href="/privacy">Privcidad</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link l" href="/terms">Terminos y condiciones</a>
			      </li>
			    </ul>
		    </form>
	  	</div>
	  </div>
	</nav>

	@yield('presentation-app')
	@yield('download')
	@yield('services')

	@yield('register')

	<div class="container parthner">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xl-12" align="center">
				<br>
				<p></p>
				<p class="af">&reg; {{date('Y')}} Powered by <a class="af" target="_blank" href="http://www.supernovaapps.com.mx">Supernova Apps</a></p>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{elixir('js/jquery.js')}}"></script>
	<script type="text/javascript" src="{{elixir('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{elixir('libs/OwlCarousel/dist/owl.carousel.min.js')}}"></script>
	@yield('js')
</body>
</html>