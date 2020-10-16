@extends('layout/plantilla')
<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script>
	$(document).ready(function() {
		$('table').DataTable({
			"language": {
				"url": "js/Spanish.json"
			},
			"lengthMenu": [
				[5, 10, -1],
				[5, 10, "Todos"]
			]
		});
	});
</script>


@section('content')

<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">OPERADOR</h2>
			</div>
			<div class="ml-md-auto py-2 py-md-0">


			</div>
		</div>
	</div>
</div>
<div id="app">
	@include('Mensaje')


	@yield('content')
</div>
<div class="col-md-15">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="multi-filter-select" class="display table table-striped table-hover">

					<thead class="bg-primary text-white">
						<tr>
							<th>ID OPERADOR</th>
							<th>NOMBRE DEL OPERADOR</th>
							@if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
							<th>Editar</th>
							@endif
							@if (Auth::user()->rol == 1)
							<th>Eliminar</th>
							@endif
						</tr>

					</thead>
					<tbody>
						@foreach ($operador as $operadores)


						<tr>
							<td>{{$operadores->id}}</td>
							<td>{{$operadores->nombre}}</td>
							{!! Form::close() !!}
							@if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
							<td>
								<a href="{{ route('operador.edit', $operadores->id) }}" class="btn btn-warning">Editar</a>
							</td>
							@endif
							@if (Auth::user()->rol == 1)
							<td>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
									Eliminar
								</button>
							</td>
							@endif
						</tr>


						@endforeach
					</tbody>




				</table>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title" id="exampleModalLabel">SEGURO QUE DESEA ELIMINAR ?</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								SE ELIMINARA EL REGISTRO
							</div>
							<div class="modal-footer">
								{!! Form::open(['method' => 'DELETE', 'route'=>['operador.destroy', $operadores->id]]) !!}
								{!! Form::submit('Eliminar', ['class' => 'btn btn-danger mt-3']) !!}
								{!! Form::close() !!}
								<button type="button" class="btn btn-primary" data-dismiss="modal">No Eliminar</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection