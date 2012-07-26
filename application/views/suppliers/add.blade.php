@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="suppliers-add">
		<div class="page-header">
			<h1>.: Agrega un proveedor</h1>
		</div>
		<div class="row-fluid">
			<div class="span4 offset4">
				<div class="form-wrapper">
					{{ Form::open('/suppliers/add', 'POST') }}
						{{ Form::label('name', 'Nombre')}}
						{{ Form::text('name') }}

						{{ Form::label('url', 'URL')}}
						{{ Form::text('url') }}

						{{ Form::label('address', 'Dirección')}}
						{{ Form::text('address') }}

						{{ Form::label('phone', 'Teléfono')}}
						{{ Form::text('phone') }}

						{{ Form::submit('Agrega el Proveedor', array('class' => 'btn-primary btn-large')) }}
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
@endsection