@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="row">
		<div class="wrapper">
			<div class="span4 offset4">
				<div class="login-box">
					<div class="greeting">
						<legend>Acceso KISS</legend>
					</div>	
					<div class="form-wrapper">
						{{ Form::open('/users/login', 'POST', array('class' => 'form-horizontal')) }}
							<fieldset>
									{{ Form::label('username', 'Usuario') }}
									{{ Form::text('username', array('class' => 'span4')) }}

									{{ Form::label('password', 'Contraseña') }}
									{{ Form::password('password', array('class' => 'span4')) }}

									<div class="row">
										{{ Form::submit('Logueate a tu cuenta', array('class' => 'btn-primary btn-large span4')) }}
									</div>
							</fieldset>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection