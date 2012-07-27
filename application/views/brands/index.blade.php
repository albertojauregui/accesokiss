@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="brands-index">
		<div class = "module-actions">
			<a href = "/brands/add" class = "btn btn-large btn-primary pull-right">
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