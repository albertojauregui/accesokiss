<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Samsara: Acceso KISS</title>
	<meta name="viewport" content="width=device-width">
	@section('assests')
		{{ HTML::style('laravel/css/style.css') }}
		{{ Asset::container('bootstrapper')->styles() }}
		{{ Asset::container('bootstrapper')->scripts() }}
		{{ HTML::style('laravel/css/default.css') }}
		{{ HTML::script('laravel/js/initializers.js') }}
	@yield_section
</head>
<body>
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<div class="btn-group menu">
					<a href="/credentials" class = "btn btn-large btn-inverse">
						<i class="icon-lock icon-white"></i>
						Accesos
					</a>
					<a href="/suppliers" class = "btn btn-large btn-inverse">
						<i class="icon-map-marker icon-white"></i>
						Proveedores
					</a>
					<a href="/brands" class = "btn btn-large btn-inverse">
						<i class="icon-tags icon-white"></i>
						Marcas
					</a>
					<a href="/users" class = "btn btn-large btn-inverse">
						<i class="icon-user icon-white"></i>
						Usuarios
					</a>
					<a href="/users/logout" class = "btn btn-large btn-danger">
						<i class="icon-remove icon-white"></i>
						Salir
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="container-box">
					<div class="row-fluid">
						<div class="span12">
							@yield('content')
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
