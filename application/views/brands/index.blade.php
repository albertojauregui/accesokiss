@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Modal para agregar marcas--}}
	<div class="modal fade hide" id="brand-add">
		<div class="form-wrapper">
			{{ Form::open('/brands/add', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Agrega una marca</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('name', 'Nombre', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('name') }}
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Agrega la marca', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Markup del index de marcas--}}
	<div class="brands-index">
		<div class = "module-actions">
			<a href = "#brand-add" class = "btn btn-large btn-primary pull-right" data-toggle = "modal">
				<i class="icon-plus icon-white"></i>
				Agregar Marca 
			</a>
		</div>
		<div class="page-header">
			<h1>.: Marcas</h1>
		</div>
		<div class="brands-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span6">
								Nombre
							</div>
							<div class="span6">
								Acciones
							</div>
						</div>
					</div>
					<div class="list-element">
						<div class="row-fluid">
							<div class = "span6">
								HP Printer
							</div>
							<div class = "span6">
								<a href = "#" class = "btn btn-primary" rel = "tooltip" title = "Mostrar proveedores">
									<i class="icon-tags icon-white"></i>
									<span class="caret"></span>
								</a>
								<a href = "#" class = "btn btn-warning" rel = "tooltip" title = "Editar la marca">
									<i class="icon-pencil icon-white"></i>
								</a>
								<a href = "#" class = "btn btn-danger" rel = "tooltip" title = "Eliminar la marca">
									<i class="icon-remove icon-white"></i>
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