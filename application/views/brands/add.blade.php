@layout('layouts.common')

@section('assets')
	@parent
@endsection

@section('content')
	<div class="brands-add container-box">
		<div class="page-header">
			<h1>.: Agrega una marca</h1>
		</div>
		<div class="row-fluid">
			<div class="span4 offset4">
				<div class="form-wrapper">
					{{ Form::open('/brands/add', 'POST') }}
						{{ Form::label('name', 'Nombre')}}
						{{ Form::text('name') }}

						{{ Form::submit('Agrega la Marca', array('class' => 'btn-primary btn-large')) }}
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
@endsection