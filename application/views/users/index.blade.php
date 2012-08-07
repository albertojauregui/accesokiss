@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Modal para agregar usuarios--}}
	<div class="modal fade hide" id="user-add">
		<div class="form-wrapper">
			{{ Form::open('/users/add', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Agrega un usuario</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('username', 'Nombre de Usuario', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('username') }}
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
							</fieldset>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Agrega el Usuario', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Modal para editar usuarios--}}
	<div class="modal fade hide" id="user-edit">
		<div class="form-wrapper">
			{{ Form::open('/users/edit/', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Edita el usuario</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('username', 'Nombre de Usuario', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('username') }}
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
							</fieldset>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Edita el Usuario', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Markup del index de usuarios--}}
	<div class="users-index">
		<div class = "module-actions">
			<a href = "#user-add" class = "btn btn-large btn-primary pull-right" data-toggle="modal">
				<i class="icon-plus icon-white"></i>
				Agregar un Usuario
			</a>
		</div>
		<div class="page-header">
			<h1>.: Usuarios</h1>
		</div>
		<div class="users-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span3">
								Usuario
							</div>
							<div class="span3">
								Contraseña
							</div>
							<div class="span3">
								Privilegios Admin
							</div>
							<div class="span3">
								Acciones
							</div>
						</div>
					</div>
					@forelse ($users as $user)
						<div class="list-element">
							<div class="row-fluid">
								<div class="span3">
									{{ $user->username }}
								</div>
								<div class="span3">
									{{ $user->password }}
								</div>
								<div class="span3">
									@if ($user->is_admin)
										<a href = "#" class = "btn btn-success">
											<i class="icon-ok icon-white"></i>
										</a>
									@else
										<a href = "#" class = "btn btn-danger">
											<i class="icon-remove icon-white"></i>
										</a>
									@endif
								</div>
								<div class="span3">
									<a href = "/users/credentials/{{ $user->id }}" class = "btn btn-primary" rel = "tooltip" title = "Manejar accesos">
										<i class="icon-lock icon-white"></i>
									</a>
									<a href = "#" class = "btn btn-warning user-edit" rel = "tooltip" title = "Editar el usuario" id = "user-edit-{{ $user->id }}" data-loading-text="Cargando...">
										<i class="icon-pencil icon-white"></i>
									</a>
									<a href = "/users/delete/{{ $user->id }}" class = "btn btn-danger btn-delete-user" id = "btn-delete-user-{{ $user->username }}" rel = "tooltip" title = "Eliminar el usuario">
										<i class="icon-remove icon-white"></i>
									</a>
								</div>
							</div>
						</div>
						<hr>
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
@endsection