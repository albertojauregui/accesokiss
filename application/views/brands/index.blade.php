@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Modal para agregar marcas--}}
	@if (Auth::user()->is_admin)
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
								{{ Form::hidden('user_id', Auth::user()->id) }}
								<div class="control-group">
									{{ Form::label('name', 'Nombre', array('class' => 'control-label'))}}
									<div class="controls">
										{{ Form::text('name') }}
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="row-fluid">
						<div class="suppliers">
							<h3>Proveedores</h3>
							<br>
							<div class="suppliers-list">
								@forelse ($suppliers as $key => $supplier)
									<div>
										<label for = "add-supplier-{{ $supplier->id }}" class = "checkbox">
											{{ Form::checkbox('suppliers[]', $supplier->id, false, array('id' => 'add-supplier-'.$supplier->id)) }}
											{{ $supplier->name }}
										</label>
									</div>
								@empty
									<div class="alert alert-danger">
										No existen proveedores
									</div>
								@endforelse
							</div>
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
	{{--Modal para editar marcas--}}
	<div class="modal fade hide" id="brand-edit">
		<div class="form-wrapper">
			{{ Form::open('/brands/edit/', 'POST', array('class' => 'form-horizontal')) }}
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal">×</button>
				    <h3>.: Edita la marca</h3>
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
					<div class="row-fluid">
						<div class="suppliers">
							<h3>Proveedores</h3>
							<br>
							<div class="suppliers-list">
								@forelse ($suppliers as $key => $supplier)
									<div>
										<label for = "edit-supplier-{{ $supplier->id }}" class = "checkbox">
											{{ Form::checkbox('suppliers[]', $supplier->id, false, array('id' => 'edit-supplier-'.$supplier->id)) }}
											{{ $supplier->name }}
										</label>
									</div>
								@empty
									<div class="alert alert-danger">
										No existen proveedores
									</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="#" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
					{{ Form::submit('Edita la marca', array('class' => 'btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
	@endif
	{{--Markup del index de marcas--}}
	<div class="brands-index">
		@if (Auth::user()->is_admin)
			<div class = "module-actions">
				<a href = "#brand-add" class = "btn btn-large btn-primary pull-right" data-toggle = "modal">
					<i class="icon-plus icon-white"></i>
					Agregar Marca 
				</a>
			</div>
		@endif
		{{--Cambio requerido para buscador se reemplaza el siguiente div porque ponía un borde inferior indeseado --}}
		{{-- <div class="page-header"> --}}
		{{--fecha 20121105 --}}
		{{--Developer: Daniel Holguin--}}
		
		<div style = "padding-bottom:17px;margin:18px 0;">
			<h1>.: Marcas y Soluciones</h1>
		</div>
		{{--Cambio requerido para buscador se agrega la siguiente tabla--}}
		{{--fecha 20121105 --}}
		{{--Developer: Daniel Holguin--}}
		<table class = "module-actions" align= "center">
		<tr>
		<td>   
			<input class = "btn-large"  id = "txt-search" placeholder = "Escriba su busqueda aqu&iacute"></input>
		</td>			
		</tr>
		<tr>
		<td style="text-align:center">								
			<button class = "btn btn-small btn-primary" id ="btn-search" >
				<i class="icon-search icon-white"></i>
				Buscar
			</button>
			<button class = "btn btn-small btn-primary" id = "btn-clear">
				<i class="icon-remove-circle icon-white"></i>   
				Limpiar
			</button>			
		</td>	
		</tr>
		</table>
		<hr>
		<div class="brands-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span8">
								Nombre
							</div>
							<div class="span2">
								Capturado por
							</div>
							<div class="span2">
								Acciones
							</div>
						</div>
					</div>
					@forelse ($brands as $brand)
					{{--Se agrega id al Sig. div y se introduce el hr que al div, antes estaba afuera de el--}}
					{{--Fecha: 20121106--}}
					{{--Developer: Daniel Holguin--}}
						<div class="list-element" Id ="brand-{{ $brand->id }}-{{ $brand->name }}">
							<div class="row-fluid">
								<div class = "span8">
									{{ $brand->name }}
								</div>
								<div class="span2">
									<p>
									<?php 
										$dbhandle = mysql_connect('localhost', 'root', '') or die("Unable to connect to MySQL");
										mysql_select_db('accesokiss', $dbhandle);
										$sql = "SELECT username FROM users WHERE id=".$brand->userid;
										$username = mysql_query($sql, $dbhandle);
										$row = mysql_fetch_row($username);
										echo $row[0];
									?>
									</p>
								</div>
								<div class = "span2">
									<a href = "#" class = "btn btn-primary slide-related" rel = "tooltip" title = "Mostrar proveedores">
										<i class="icon-tags icon-white"></i>
										<span class="caret"></span>
									</a>
									@if (Auth::user()->is_admin)
										<a href = "#" class = "btn btn-warning brand-edit" rel = "tooltip" title = "Editar la marca" id = "brand-edit-{{ $brand->id }}" data-loading-text="Cargando...">
											<i class="icon-pencil icon-white"></i>
										</a>
										<a href = "/brands/delete/{{ $brand->id }}" class = "btn btn-danger btn-delete-brand" id = "btn-delete-brand-{{ $brand->name }}" rel = "tooltip" title = "Eliminar la marca">
											<i class="icon-remove icon-white"></i>
										</a>
									@endif
								</div>
							</div>
							<div class="row-fluid hide related-container">
								@forelse ($brand->suppliers as $supplier)
									<div class="span3">
										<i class="icon-map-marker"></i>
										<strong>
											{{ $supplier->name }}
										</strong>
									</div>
								@empty
									<div class="alert alert-error">
										No encontramos ningún proveedor para esta marca
									</div>
								@endforelse
							</div>
							<hr> {{--Esté hr fue cambiado de padré antes fue hermano de su actual padre 20121006--}} 
							 {{--Developer: Daniel Holguín--}}
						</div>
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
@endsection