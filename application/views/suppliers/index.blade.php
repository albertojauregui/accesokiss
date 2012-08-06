@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Modal para agregar proveedores--}}
	<div class="modal fade hide" id="supplier-add">
		<div class="form-wrapper">
			{{ Form::open('/suppliers/add', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Agrega un proveedor</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('name', 'Nombre del Proveedor', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('name') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('url', 'Sitio Web', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('url') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('address', 'Ubicado en', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('address') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('phone', 'Flete', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('phone') }}
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="row-fluid">
						<div class="suppliers">
							<h3>Marcas</h3>
							<div class="suppliers-list">
								@forelse ($brands as $key => $brand)
									<?php $class = ($key % 3 == 0) ? 'no-margin': ''; ?>
									<div class="span1 {{ $class }}">
										{{ Form::checkbox('brands[]', $brand->id) }}
									</div>
									<div class="span3">
										{{ $brand->name }}
									</div>
								@empty
									<div class="alert alert-danger">
										No existen marcas
									</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Agrega el Proveedor', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Modal para editar proveedores--}}
	<div class="modal fade hide" id="supplier-edit">
		<div class="form-wrapper">
			{{ Form::open('/suppliers/edit/', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Edita el proveedor</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span1">&nbsp;</div>	
						<div class="span10">
							<fieldset>
								<div class="control-group">
									{{ Form::label('name', 'Nombre del Proveedor', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('name') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('url', 'Sitio Web', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('url') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('address', 'Ubicado en', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('address') }}
									</div>
								</div>
								<div class="control-group">
									{{ Form::label('phone', 'Flete', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('phone') }}
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="row-fluid">
						<div class="suppliers">
							<h3>Marcas</h3>
							<div class="suppliers-list">
								@forelse ($brands as $key => $brand)
									<?php $class = ($key % 3 == 0) ? 'no-margin': ''; ?>
									<div class="span1 {{ $class }}">
										{{ Form::checkbox('brands[]', $brand->id) }}
									</div>
									<div class="span3">
										{{ $brand->name }}
									</div>
								@empty
									<div class="alert alert-danger">
										No existen marcas
									</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Edita el Proveedor', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	{{--Markup del index de proveedores--}}
	<div class="suppliers-index">
		<div class = "module-actions">
			<a href = "#supplier-add" class = "btn btn-large btn-primary pull-right" data-toggle = "modal">
				<i class="icon-plus icon-white"></i>
				Agregar Proveedor
			</a>
		</div>
		<div class="page-header">
			<h1>.: Proveedores</h1>
		</div>
		<div class="suppliers-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span3">
								Nombre
							</div>
							<div class="span3">
								Página Web
							</div>
							<div class="span2">
								Ubicado en
							</div>
							<div class="span2">
								Flete
							</div>
							<div class="span2">
								Acciones
							</div>
						</div>
					</div>
					@forelse ($suppliers as $supplier)
						<div class="list-element">
							<div class="row-fluid">
								<div class="span3">
									{{ $supplier->name }}
								</div>
								<div class="span3">
									{{ $supplier->url }}
								</div>
								<div class="span2">
									{{ $supplier->address }}
								</div>
								<div class="span2">
									{{ $supplier->phone }}
								</div>
								<div class="span2">
									<a href = "#" class = "btn btn-warning supplier-edit" rel = "tooltip" title = "Editar el proveedor" id = "supplier-edit-{{ $supplier->id }}" data-loading-text="Cargando...">
										<i class="icon-pencil icon-white"></i>
									</a>
									<a href = "/suppliers/delete/{{ $supplier->id }}" class = "btn btn-danger" rel = "tooltip" title = "Eliminar el proveedor">
										<i class="icon-remove icon-white"></i>
									</a>
								</div>
							</div>
							<div class="row-fluid hide">
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