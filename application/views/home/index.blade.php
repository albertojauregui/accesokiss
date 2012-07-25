@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="row">
		<div class="span4 offset4">
			<h1>Acceso KISS</h1>
			<div class="login-box">
				<div class="greeting">
					<div class="page-header">
						<h1><small>Bienvenido</small></h1>
					</div>
				</div>	
				<div class="form-wrapper">
					{{ Form::open('/users/login', 'POST') }}
						{{ Form::label('username', 'Usuario')}}
						{{ Form::text('username') }}

						{{ Form::label('password', 'Contraseña')}}
						{{ Form::password('password') }}

						{{ Form::submit('Logueate a tu cuenta', array('class' => 'btn-primary btn-large')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection