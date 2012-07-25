@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<h1>Acceso KISS</h1>
	<div class="login-box">
		<div class="greeting">
		</div>	
		<div class="form-wrapper">
			{{ Form::open('user/login', 'POST') }}
				{{ Form::label('username', 'Usuario')}}
				{{ Form::text('username') }}

				{{ Form::label('password', 'Contraseña')}}
				{{ Form::password('password') }}

				{{ Form::submit('Logueate a tu cuenta') }}
			{{ Form::close() }}
		</div>
	</div>
@endsection