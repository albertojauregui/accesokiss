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
					<legend>Bienvenido</legend>
				</div>	
				<div class="form-wrapper">
					{{ Form::open('/users/login', 'POST', array('class' => 'form-horizontal')) }}
						<fieldset>
							<div class="control-group">
								{{ Form::label('username', 'Usuario', array('class' => 'control-label'))}}
								<div class="controls">
									{{ Form::text('username') }}
								</div>
							</div>

							<div class="control-group">
								{{ Form::label('password', 'Contraseña', array('class' => 'control-label'))}}
								<div class="controls">
									{{ Form::password('password') }}
								</div>
							</div>

							{{ Form::submit('Logueate a tu cuenta', array('class' => 'btn-primary btn-large')) }}
						</fieldset>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection