@extends('layout/plantilla')
<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>

<script>
$(document).ready(function() {
    var table = $('#table').DataTable({
        "processing": true,
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
                <h2 class="text-white pb-2 fw-bold">INGRESO Y CONTROL</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
            </div>
        </div>
    </div>
</div>


<div class="page-inner mt--1">
    <div class="col mt--2">
        <div class="col-md-5 mx-auto">
            <div class="card height">
                <div class="card-body">
                    <center>
                        <div class="form-group">{!! Form::label('cantidad', 'CREAR REGISTRO INGRESO A GESTION HUMANA:')
                            !!}</div>
                        <a href="{{url('/humana/create')}}" class="btn btn-primary btn-round">CREAR REGISTRO</a>
                    </center>


                </div>
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
                <table id="table" class="display table table-striped table-hover">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th>NOMBRE DEL OPERADOR</th>
                            <th>HORA ENTRADA</th>
                            <th>HORA SALIDA</th>
                            <th>TIEMPO</th>
                            <th>MOTIVO</th>
                            <th>FECHA</th>
                            <th>OBSERVACIONES</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($gestion as $gestion)
                        <tr>

                            <td>{{$gestion->id}}</td>
                            <td>{{$gestion->inicial}}</td>
                            <td>{{$gestion->final}}</td>
                            <td>{{$gestion->tiempo}}</td>
                            <td>{{$gestion->motivo}}</td>
                            <td>{{$gestion->fecha}}</td>
                            <td>{{$gestion->observacion}}</td>




                            {!! Form::close() !!}
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>

@endsection