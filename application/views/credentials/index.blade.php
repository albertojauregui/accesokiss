@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Modal para agregar proveedores--}}
	<div class="modal fade hide modal-credentials" id="credential-add">
		<div class="form-wrapper">
			{{ Form::open('/credentials/add', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Agrega un acceso</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('user', 'Nombre del Usuario', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('user') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('password', 'Contraseña', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('password') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('supplier', 'Proveedor', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::select('supplier', array('0' => 'Cargando Proveedores...')) }}
									</div>
								</div>
								{{ Form::hidden('user_id', $user_id) }}
							</fieldset>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Agrega el acceso', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Markup del index de proveedores--}}
	<div class="credentials-index">
		<div class = "module-actions">
			<a href = "#credential-add" class = "btn btn-large btn-primary pull-right" data-toggle = "modal">
				<i class="icon-plus icon-white"></i>
				Agregar Acceso
			</a>
		</div>
		<div class="page-header">
			<h1>.: Accesos a los Proveedores</h1>
		</div>
		<div class="credentials-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span3">
								Nombre
							</div>
							<div class="span3">
								Usuario
							</div>
							<div class="span2">
								Contraseña
							</div>
							<div class="span2">
								Sitio Web
							</div>
							<div class="span2">
								Acciones
							</div>
						</div>
					</div>
					@forelse ($credentials[0]->suppliers as $supplier)
						<div class="list-element">
							<div class="row-fluid">
								<div class="span3">
									{{ $supplier->name }}
									<a href = "#" class = "btn btn-info" rel = "tooltip" title = "{{ $supplier->address }} - {{ $supplier->phone }}">
										<i class="icon-info-sign icon-white"></i>
									</a>
								</div>
								<div class="span3">
									{{ $supplier->pivot->user }}
								</div>
								<div class="span2">
									{{ $supplier->pivot->password }}
								</div>
								<div class="span2">
									<a href = "{{ $supplier->url }}" class = "btn btn-primary visitar-proveedor" target = "_blank">
										<i class="icon-share icon-white"></i>
										Visitar
									</a>
								</div>
								<div class="span2">
									<a href = "#" class = "btn btn-primary slide-related" rel = "tooltip" title = "Mostrar marcas">
										<i class="icon-tags icon-white"></i>
										<span class="caret"></span>
									</a>
									<a href = "#" class = "btn btn-warning" rel = "tooltip" title = "Editar el acceso">
										<i class="icon-pencil icon-white"></i>
									</a>
									<a href = "/credentials/delete/{{ $credentials[0]->id }}/{{ $supplier->pivot->id }}" class = "btn btn-danger" rel = "tooltip" title = "Eliminar el acceso">
										<i class="icon-remove icon-white"></i>
									</a>
								</div>
							</div>
							<div class="row-fluid hide related-container">
								<h3>Marcas del Proveedor</h3>
								@forelse ($supplier->brands as $brand)
									<div class="span3">
										{{ $brand->name }}
									</div>
								@empty
									<div class="alert alert-error">
										No encontramos ninguna marca para el proveedor
									</div>
								@endforelse
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