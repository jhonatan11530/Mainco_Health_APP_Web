<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>MAINCO HEALTH CARE</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{url('img/icon.png')}}" type="image/png" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">



	<!-- CSS Files -->
	<link rel="stylesheet" href="{{url('css/fonts.min.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/atlantis.min.css')}}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{url('css/demo.css')}}">
	@yield('styles')

</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.html" class="logo">
					<strong>
						<font color="white">MAINCO HEALTH CARE</font>
					</strong>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fas fa-align-justify"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			</div>

			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">

					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">

							</a>
							<!-- TODO: Cambiar el ancho de la tarjeta del perfil-->
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">


								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title" id="exampleModalLongTitle">Usuario Inactivo</h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h2>
							¿ Desea Cerrar sesión por inactividad o mantener su sesión activa ?
						</h2>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="Exit();">Cerrar sesión</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Reset();">Mantener Activo</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="info">
							<a data-toggle="collapse" aria-expanded="false">


								<span>
									Usuario : {{ Auth::user()->nomusuario}} {{ Auth::user()->apeusuario}}

									<br>
									Cargo : {{ Auth::user()->cargo}}
							</a>
							<br>
							<a class="btn btn-primary" href="{{ url('logout') }}"><strong>Cerrar Sesión</strong></a>
							</span>
							</a>
						</div>
					</div>

					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" class="collapsed">
								<i class="fas fa-clock"></i>
								<p id="demo"></p>
							</a>

						</li>
					</ul>

					@if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" href="#menu" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>AREA PRODUCCION</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="menu">
								<ul class="nav nav-collapse">

									<li>
										<a href="{{ url('inicio') }}">
											<i class="fas fa-puzzle-piece"></i>
											<span>INICIO</span>
										</a>
									</li>
									<li>
										<a href="{{ url('operador') }}">
											<i class="fas fa-id-badge"></i>
											<span>OPERADORES</span>
										</a>
									</li>
									@if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
									<li>
										<a href="{{ url('control') }}">
											<i class="fas fa-id-badge"></i>
											<span>SUPERVISAR OPERADORES</span>
										</a>
									</li>


									<li>
										<a href="{{ url('produccion') }}">
											<i class="fas fa-cubes"></i>
											<span>ORDEN DE PRODUCCION</span>
										</a>
									</li>
									@endif

									@if (Auth::user()->rol == 1)
									<li>
										<a href="{{ url('usuarios') }}">
											<i class="fas fa-address-card"></i>
											<span>GESTION DE USUARIOS</span>
										</a>
									</li>
									@endif
									@if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
									<li>
										<a href="{{ url('exportar') }}">
											<i class="fas fa-cloud-download-alt"></i>
											<span>EXPORTAR DATOS</span>
										</a>

									</li>
									@endif

									</a>
						</li>
					</ul>
				</div>
				</li>
				</ul>
				@endif

				@if ((Auth::user()->rol == 4))
				<ul class="nav nav-primary">
					<li class="nav-item active">
						<a data-toggle="collapse" href="#gestion" class="collapsed" aria-expanded="false">
							<i class="fas fa-home"></i>
							<p>GESTION HUMANA</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="gestion">
							<ul class="nav nav-collapse">

								<li>
									<a href="{{ url('humana') }}">
										<i class="fas fa-id-badge"></i>
										<span>INGRESO A GESTION HUMANA</span>
									</a>
								</li>
								<li>
									<a href="{{ url('usuarios') }}">
										<i class="fas fa-id-badge"></i>
										<span>GESTION DE USUARIOS</span>
									</a>
								</li>
								<li>
									<a href="{{ url('exportar') }}">
										<i class="fas fa-cloud-download-alt"></i>
										<span>EXPORTAR DATOS</span>
									</a>

								</li>

								</a>
					</li>
				</ul>
			</div>
			</li>

			</ul>
			@endif

		</div>
	</div>
	</div>

	<!-- End Sidebar -->

	<div class="main-panel">
		<div class="content">
			@yield('content')
		</div>
		<footer class="footer">
			<div class="container-fluid">

				<div class="copyright ml-left">
					Copyright © 2019 Mainco Health Care <br>

				</div>
				<div class="copyright ml-auto">
					powered by <b><a href="tel:+57 3114360830">jhonatan fernandez</a></b> <br>

				</div>
			</div>
		</footer>
	</div>

	<!-- Custom template | don't include it in your project! -->
	<div class="custom-template">
		<div class="title">Configuración</div>
		<div class="custom-content">
			<div class="switcher">
				<div class="switch-block">
					<h4>Cambiar Color Logo</h4>
					<div class="btnSwitch">
						<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
						<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
						<br />
						<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
						<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Cambiar Color Barra Superior</h4>
					<div class="btnSwitch">
						<button type="button" class="changeTopBarColor" data-color="dark"></button>
						<button type="button" class="changeTopBarColor" data-color="blue"></button>
						<button type="button" class="changeTopBarColor" data-color="purple"></button>
						<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
						<button type="button" class="changeTopBarColor" data-color="green"></button>
						<button type="button" class="changeTopBarColor" data-color="orange"></button>
						<button type="button" class="changeTopBarColor" data-color="red"></button>
						<button type="button" class="changeTopBarColor" data-color="white"></button>
						<br />
						<button type="button" class="changeTopBarColor" data-color="dark2"></button>
						<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
						<button type="button" class="changeTopBarColor" data-color="purple2"></button>
						<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
						<button type="button" class="changeTopBarColor" data-color="green2"></button>
						<button type="button" class="changeTopBarColor" data-color="orange2"></button>
						<button type="button" class="changeTopBarColor" data-color="red2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Cambiar Color Barra Lateral</h4>
					<div class="btnSwitch">
						<button type="button" class="selected changeSideBarColor" data-color="white"></button>
						<button type="button" class="changeSideBarColor" data-color="dark"></button>
						<button type="button" class="changeSideBarColor" data-color="dark2"></button>
					</div>
				</div>
				<div class="switch-block">
					<h4>Cambiar Color De Fondo</h4>
					<div class="btnSwitch">
						<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
						<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
						<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
						<button type="button" class="changeBackgroundColor" data-color="dark"></button>
					</div>
				</div>
			</div>
		</div>


		<div class="custom-toggle">
			<i class="fas fa-atom"></i>
		</div>
	</div>
	<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{url('js/core/popper.min.js')}}"></script>
	<script src="{{url('js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{url('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{url('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{url('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{url('js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{url('js/atlantis.min.js')}}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{url('js/setting-demo.js')}}"></script>

	<!-- Fonts and icons -->
	<script src="{{url('js/plugin/webfont/webfont.min.js')}}"></script>

	<script>
		// Set the date we're counting down to
		var countDownDate = new Date();
		countDownDate.setHours(countDownDate.getHours() + 2);
		//var real = countDownDate.getHours()+1+":"+countDownDate.getMinutes()+":"+countDownDate.getSeconds();

		// Update the count down every 1 second
		var x = setInterval(function() {

			// Get today's date and time
			var now = new Date().getTime();

			// Find the distance between now and the count down date
			var distance = countDownDate - now;
			// Time calculations for days, hours, minutes and seconds
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			// Output the result in an element with id="demo"
			document.getElementById("demo").innerHTML = hours + "H " +
				minutes + "M " + seconds + "S";
			document.getElementById("demo").style.color = "#000000";
			document.getElementById("demo").style.fontSize = "18px";
			// If the count down is over, write some text 

			if (hours=0 && minutes < 20) {
				clearInterval(x);
				$('#exampleModalCenter').modal('show');
			}

			if (distance = 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRO";
				window.location.href = "{{ url('logout') }}";
			}


		}, 1000);

		function Reset() {
			document.getElementById("demo").innerHTML = "REINICIANDO";
			// Set the date we're counting down to
			var countDownDate = new Date();
			countDownDate.setHours(countDownDate.getHours() + 2);

			// Update the count down every 1 second
			var x = setInterval(function() {
				
				// Get today's date and time
				var now = new Date().getTime();

				// Find the distance between now and the count down date
				var distance = countDownDate - now;

				// Time calculations for days, hours, minutes and seconds
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				// Output the result in an element with id="demo"
				document.getElementById("demo").innerHTML = hours + "H " +
					minutes + "M " + seconds + "S";
				document.getElementById("demo").style.color = "#000000";
				document.getElementById("demo").style.fontSize = "18px";

				if (hours=0 && minutes < 20) {
				clearInterval(x);
				$('#exampleModalCenter').modal('show');
			}
			}, 1000);
		}

		function Exit() {
			window.location.href = "{{ url('logout') }}";
		}
	</script>

	@yield('scripts')

</body>

</html>