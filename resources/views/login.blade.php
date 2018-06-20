<!DOCTYPE html>
<html>
<head>
	<title>Pidelo Tu</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Login, Bienvenido, usuario, contraseña, entrar, inicio">
	<meta name="theme-color" content="#11c0f6">
	<meta name="description" content="Ordena lo que mas te gusta sin tener que moverte de donde estás"/>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->

	<!-- Custom Theme files -->
	<link href="/css/login.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="{{elixir('css/bootstrap.css')}}">
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<!-- //web font -->

	<!--Icon-->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/ic.png')}}"/>
	<!--//Icon-->

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12" align="center">
				<img class="img" src="{{asset('images/icons/icon-logo-login.png')}}">
			</div>
			<div class="col-md-12" align="center">
				<button class="btn btn-info" data-toggle="modal" data-target="#myModal" style="color: white; border-radius: 1.5rem; width: 30%; height: 60px;">Ingresar</button>
				<!--<div class="main">
					<div class="main-w3lsrow">
						<div class="login-form login-form-left">
							<div class="agile-row">
								<div class="head">
									<h2>Bienvenido</h2>
									<span class="fa fa-lock"></span>
								</div>
								<div class="clear"></div>
								<div class="login-agileits-top">
									<form action="#" method="POST">
										<input type="text" id="email" class="name" name="user name" Placeholder="Usuario" required/>
										<input type="password" id="password" class="password" name="Password" Placeholder="Contraseña" required/>
										<button type="button" id="check" name="button">Entrar</button>
									</form>
								</div>
								<div class="login-agileits-bottom">
									
								</div>

							</div>
						</div>
					</div>
				</div>-->
			</div>
		</div>
		<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" align="center" style="background-color: #4267b2">
      	<div class="row" style="width: 100%;">
      		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		<div class="col-md-12" align="center">
      			<img src="{{ asset('images/logo-white.png') }}" alt="pidelo-tu_logo" id="header-logo-normal">
			      <p style="color: white; font-size: 2rem; font-family: 'Raleway', sans-serif;">Iniciar Sesión</p>
      		</div>
      	</div>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
					<input style="padding: .8em 1em; outline: none; font-size: .9em; letter-spacing: 1px; color: #666; padding: 1em 1em; margin: 0; width: 100%; box-sizing: border-box; margin-bottom: 1em; -webkit-appearance: none; display: block; border: 1px solid #dde0df; background: #e4eae7; font-family: 'Raleway', sans-serif;" type="text" id="email" class="name" name="user name" Placeholder="Usuario" required/>
					<input style="padding: .8em 1em; outline: none; font-size: .9em; letter-spacing: 1px; color: #666; padding: 1em 1em; margin: 0; width: 100%; box-sizing: border-box; margin-bottom: 1em; -webkit-appearance: none; display: block; border: 1px solid #dde0df; background: #e4eae7; font-family: 'Raleway', sans-serif;" type="password" id="password" class="password" name="Password" Placeholder="Contraseña" required/>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="check" name="button">Entrar</button>
      </div>
    </div>

  </div>
</div>

		<!-- copyright -->
		<div class="copyright">
			<p> © 2018 Creado por: <a href="http://supernovaapps.com.mx" target="_blank">Supernova Apps</a></p>
		</div>
		<!-- //copyright -->
	</div>
	<!-- //main -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/js/login.js"></script>
	<script type="text/javascript" src="{{elixir('js/bootstrap.min.js')}}"></script>
</body>
</html>
