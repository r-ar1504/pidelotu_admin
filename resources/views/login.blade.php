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
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<!-- //web font -->

	<!--Icon-->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/ic.png')}}"/>
	<!--//Icon-->

</head>
<body>
	<!-- main -->
	<div class="main">
		<h1>Pídelo Tú</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
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
						<!-- <h6><a href="#">Forgot your password?</a></h6> -->
					</div>

				</div>
			</div>
		</div>
		<!-- //login form -->

		<!-- copyright -->
		<div class="copyright">
			<p> © 2018 Creado por: <a href="http://supernovaapps.com.mx" target="_blank">Supernova Apps</a></p>
		</div>
		<!-- //copyright -->
	</div>
	<!-- //main -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/js/login.js"></script>
</body>
</html>
