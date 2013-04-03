@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="users-index">
		<div class="page-header">
			<h1>.: Autorizaciones</h1>
		</div>
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
		<div class="users-list">
			<div class="row-fluid">
				<div class="span12">
					<div class="list-header">
						<div class="row-fluid">
							<div class="span2">
								Usuario
							</div>
							<div class="span8">
								Descripción
							</div>
							<div class="span2">
								Acciones
							</div>
						</div>
					</div>
					<?php 
						mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
						mysql_select_db("accesokiss");
						$result = mysql_query("SELECT u.id, u.username, s.name AS sname, s.id AS sid FROM users u LEFT JOIN suppliers s ON s.userid=u.id WHERE s.approved=0 ORDER BY created_at DESC");
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						    echo '<div class="list-element" id="record-'.$row["sid"].'-'.$row["sname"].'"><div class="row-fluid">';
						    echo '<div class="span2">'.$row["username"].'</div>';
						    echo '<div class="span8">'.$row["sname"].'</div>';
						    echo '<div class="span2"><a href="/authorizations/edit/'.$row["sid"].'/2" class="btn btn-success authorization-edit" rel="tooltip" title="Autorizar el registro" id="authorization-authorize-'.$row["sid"].'"><i class="icon-ok icon-white"></i></a>&nbsp;<a href="/authorizations/delete/'.$row["sid"].'/2" class="btn btn-danger btn-delete-authorization" id="btn-delete-authorization-'.$row["sid"].'" rel="tooltip" title="Eliminar el registro"><i class="icon-remove icon-white"></i></a></div>';
						    echo '</div><hr></div>';
						}
						mysql_free_result($result);

						$result = mysql_query("SELECT u.id, u.username, b.name AS bname, b.id AS bid FROM users u LEFT JOIN brands b ON b.userid=u.id WHERE b.approved=0 ORDER BY created_at DESC");
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						    echo '<div class="list-element" id="record-'.$row["bid"].'-'.$row["bname"].'"><div class="row-fluid">';
						    echo '<div class="span2">'.$row["username"].'</div>';
						    echo '<div class="span8">'.$row["bname"].'</div>';
						    echo '<div class="span2"><a href="/authorizations/edit/'.$row["bid"].'/1" class="btn btn-success authorization-edit" rel="tooltip" title="Autorizar el registro" id="authorization-authorize-'.$row["bid"].'"><i class="icon-ok icon-white"></i></a>&nbsp;<a href="/authorizations/delete/'.$row["bid"].'/1" class="btn btn-danger btn-delete-authorization" id="btn-delete-authorization-'.$row["bid"].'" rel="tooltip" title="Eliminar el registro"><i class="icon-remove icon-white"></i></a></div>';
						    echo '</div><hr></div>';
						}
						mysql_free_result($result);
					?>
				</div>
			</div>
		</div>
	</div>
@endsection