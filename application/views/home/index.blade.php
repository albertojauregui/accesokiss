@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="row">
		<div class="span4 offset4">
			<div class="login-box">
				<div class="row-fluid">
					<div class="span12">
						<div class="greeting">
							<legend>Acceso KISS</legend>
						</div>	
						<div class="form-wrapper">
							{{ Form::open('/users/login', 'POST', array('class' => 'form-horizontal')) }}
								<fieldset>
										{{ Form::label('username', 'Usuario') }}
										{{ Form::text('username') }}

										{{ Form::label('password', 'Contraseña') }}
										{{ Form::password('password') }}

										{{ Form::submit('Logueate a tu cuenta', array('class' => 'btn-primary btn-large span12')) }}
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection