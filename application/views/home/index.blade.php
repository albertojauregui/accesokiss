<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Laravel: A Framework For Web Artisans</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('laravel/css/style.css') }}
	{{ Asset::container('bootstrapper')->styles() }}
	{{ Asset::container('bootstrapper')->scripts() }}
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span4 offset4">
				<div class="title">
					<h1>Acceso KISS</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span4 offset4 container-box">
				<div class="login-box">
					<div class="row-fluid">
						<div class="span12">
							<div class="greeting">
								<h3>Bienvenido</h3>
							</div>	
							<div class="form-wrapper">
								{{ Form::open('/users/login', 'POST', array('class' => 'form-horizontal')) }}
									<fieldset>
										{{ Form::text('username', null, array('class' => 'span12', 'placeholder' => 'Usuario')) }}

										{{ Form::password('password', array('class' => 'span12', 'placeholder' => 'Contraseña')) }}

										{{ Form::submit('Logueate a tu cuenta', array('class' => 'btn-primary btn-large span12')) }}
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
