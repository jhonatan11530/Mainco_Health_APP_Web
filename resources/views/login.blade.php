<!DOCTYPE html>
<html lang="en">

<head>
	<title>LOGIN MAINCO APP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" href="{{url('img/mainco.jpg')}}" type="image/png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/animate/animate.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/animsition/css/animsition.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('vendor/daterangepicker/daterangepicker.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/main.css')}}">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/mainco.jpg'); background-size: 100%;">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="validar" method="POST" autocomplete="off">
					{{ csrf_field() }}
					<span class="login100-form-logo">
						<img src="img/mainco.jpg" height="60px">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						INICIAR SECCION
					</span>

					<div class="wrap-input100 validate-input" data-validate="PORFAVOR INGRESE EL USUARIO">
						<input class="input100" type="text" name="cedula" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="PORFAVOR INGRESE LA CONTRASEÑA">
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Ingresar
						</button>
					</div>


					<div>
						@if( Session::has('message'))
						<?php
						if (Session::get('message') == "Error en los datos de acceso") {
							echo "<br>";
							echo 'ERROR EN LOS DATOS DE ACCESO';
						}
						?>
						@endif

					</div>

			</div>
			</form>

		</div>
	</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="{{url('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('vendor/animsition/js/animsition.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('vendor/select2/select2.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{url('vendor/daterangepicker/daterangepicker.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('vendor/countdowntime/countdowntime.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{url('js/main.js')}}"></script>

</body>

</html>