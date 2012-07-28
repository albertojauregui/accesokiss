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
								{{ Form::hidden('user_id', Auth::user()->id) }}
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
					<div class="list-element">
						<div class="row-fluid">
							<div class="span3">
								Radio Antes del Caribe S.A. de C.V.
							</div>
							<div class="span3">
								PedroPablo2000
							</div>
							<div class="span2">
								ticotaco6000
							</div>
							<div class="span2">
								<a href = "http://www.mongeeks.com.mx" class = "btn btn-primary visitar-proveedor" target = "_blank">
									<i class="icon-share icon-white"></i>
									Visitar
								</a>
							</div>
							<div class="span2">
								<a href = "#" class = "btn btn-primary" rel = "tooltip" title = "Mostrar marcas">
									<i class="icon-tags icon-white"></i>
									<span class="caret"></span>
								</a>
								<a href = "#" class = "btn btn-info" rel = "tooltip" title = "Más detalles">
									<i class="icon-info-sign icon-white"></i>
								</a>
								<a href = "#" class = "btn btn-warning" rel = "tooltip" title = "Editar el acceso">
									<i class="icon-pencil icon-white"></i>
								</a>
							</div>
						</div>
					</div>
					<hr>
					<div class="list-element">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection