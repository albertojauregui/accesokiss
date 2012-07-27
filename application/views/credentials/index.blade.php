@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="credentials-index">
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