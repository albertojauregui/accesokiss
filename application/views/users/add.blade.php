@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="users-add">
		<div class="page-header">
			<h1>.: Agrega un usuario</h1>
		</div>
		<div class="row-fluid">
			<div class="span4">&nbsp;</div>
			<div class="span4">
				<div class="form-wrapper">
					{{ Form::open('/users/add', 'POST', array('class' => 'form-horizontal')) }}
						<fieldset>
							<div class="control-group">
								{{ Form::label('name', 'Nombre de Usuario', array('class' => 'control-label'))}}
								<div class="controls">
									{{ Form::text('name') }}
								</div>
							</div>

							<div class="control-group">
								{{ Form::label('password', 'Contraseña', array('class' => 'control-label'))}}
								<div class="controls">
									{{ Form::text('password') }}
								</div>
							</div>

							<div class="control-group">
								{{ Form::label('is_admin', '¿Es admin?', array('class' => 'control-label'))}}
								<div class="controls">
									<label class="checkbox">
										{{ Form::checkbox('is_admin', 1) }}
									</label>
								</div>
							</div>

							{{ Form::submit('Agrega el Usuario', array('class' => 'btn-primary btn-large')) }}
						</fieldset>
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
@endsection