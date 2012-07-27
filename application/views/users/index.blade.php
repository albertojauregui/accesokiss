@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="users-index">
		<div class = "module-actions">
			<a href = "/users/add" class = "btn btn-large btn-primary pull-right">
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
					<div class="list-element">
						<div class="row-fluid">
							<div class="span3">
								Chuy1782
							</div>
							<div class="span3">
								tetolilomandamas78000
							</div>
							<div class="span3">
								<a href = "#" class = "btn btn-success">
									<i class="icon-ok icon-white"></i>
								</a>
							</div>
							<div class="span3">
								<a href = "#" class = "btn btn-warning" rel = "tooltip" title = "Editar el usuario">
									<i class="icon-pencil icon-white"></i>
								</a>
								<a href = "#" class = "btn btn-danger" rel = "tooltip" title = "Eliminar el usuario">
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