@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="suppliers-index">
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
								Dirección
							</div>
							<div class="span2">
								Teléfono
							</div>
							<div class="span2">
								Acciones
							</div>
						</div>
					</div>
					<div class="list-element">
						<div class="row-fluid">
							<div class="span3">
								Radio antenas del Cariba S.A. de C.V.
							</div>
							<div class="span3">
								http://www.mongeeks.com.mx
							</div>
							<div class="span2">
								Av. Lombardo Soberano #18 Catapulta 3
							</div>
							<div class="span2">
								9985772496
							</div>
							<div class="span2">
								<a href = "#" class = "btn btn-warning" rel = "tooltip" title = "Editar el proveedor">
									<i class="icon-pencil icon-white"></i>
								</a>
								<a href = "#" class = "btn btn-danger" rel = "tooltip" title = "Eliminar el proveedor">
									<i class="icon-remove-sign icon-white"></i>
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