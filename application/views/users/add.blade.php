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
			<div class="span4 offset4">
				<div class="form-wrapper">
					{{ Form::open('/users/add', 'POST') }}
						{{ Form::label('name', 'Nombre de Usuario')}}
						{{ Form::text('name') }}

						{{ Form::label('password', 'Contraseña')}}
						{{ Form::text('password') }}

						{{ Form::label('is_admin', '¿Es admin?')}}
						{{ Form::checkbox('is_admin', 1) }}

						{{ Form::submit('Agrega el Usuario', array('class' => 'btn-primary btn-large')) }}
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
@endsection