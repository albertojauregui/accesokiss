@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	{{--Markup del index de logins--}}		
		<div style = "padding-bottom:17px;margin:18px 0;"> 
			<h1>.: Monitor</h1>
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
		<table class="table table-bordered table-condensed" align= "center">
		  <thead>
        <tr>            
            <th style="text-align:center"> Usuario</th>
            <th style="text-align:center">Hora</th>
            <th style="text-align:center">Fecha</th>        	
        </tr>
    	</thead>		
		@forelse ($userlogin as $login)				 		
			<?php 
					$username = $login->Users->username; 
					$date = strtotime($login->updated_at);
					$time = date('h:i:s A',$date);					
					$date = date('d-m-Y',$date);
			?>
			<tr class="list-element" id ="userlogins-{{$login->id}}-{{$username}}" > 
				<td style="text-align:center"> 
					{{$username;}}
				</td>
				<td style="text-align:right">
			 		{{$time}}
				</td>
				<td style="text-align:right">
			 		{{$date}}
				</td>
			</tr>				
		@empty		
		@endforelse
		</table>		
@endsection