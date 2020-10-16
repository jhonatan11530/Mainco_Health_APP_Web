@extends('layout/plantilla')
<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" href="{{url('css/jquery.dataTables.min.css')}}">

@section('content')

<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="col mt--2">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body">
					<div class="table-responsive">
						<table id="multi-filter-select" class="display table table-striped table-hover">
							<thead class="bg-primary text-white">
								<tr>
									<div class="table-responsive">
										<center>
											<img src="{{asset('img/mainco.jpg')}}" width='auto' height='150' />
										</center>
									</div>
								</tr>
								<div class="table-responsive">
									<tr>
										<th colpan="2">
											<center>
												<h2><strong>BIENVENIDO AL SISTEMA MAINCO APP</strong></h2>
											</center>
										</th>
										<th></th>
									</tr>

							</thead>
							<tbody>
								<tr>

									<td colpan="2">
										<h2>En este sistema se podra consultar o extraer informacion sobre el area de produccion de la empresa <strong>MAINCO HEALTH CARE<br><br>

												COMO FUNCIONA MAINCO APP</strong><br><br>Su principal funcionamiento es extraer informacion o generar un informe sobre los operadores y las cantidades produccidas o rechazadas,tener un control mas preciso en los tiempos de paro</h2>
									</td>
									<td></td>
								</tr>
					</div>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection