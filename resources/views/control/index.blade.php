@extends('layout/plantilla')
<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('js/moment.js')}}"></script>

<script>
$(document).ready(function() {
    var table = $('#operador').DataTable({
        "processing": true,
        "language": {
            "url": "js/Spanish.json"
        },
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "Todos"]
        ]
    });

    var table1 = $('#motivo').DataTable({
        "processing": true,
        "language": {
            "url": "js/Spanish.json"
        },
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "Todos"]
        ]
    });

    $('#codigo').on('keyup', function() {
        if (table.column(0).search() !== this.value) {
            table
                .column(0)
                .search(this.value)
                .draw();
        }
        if (table1.column(0).search() !== this.value) {
            table1
                .column(0)
                .search(this.value)
                .draw();
        }
    });

    $('#nombre').on('keyup', function() {
        if (table.column(1).search() !== this.value) {
            table
                .column(1)
                .search(this.value)
                .draw();
        }

    });

    $('#op').on('keyup', function() {
        if (table.column(2).search() !== this.value) {
            table
                .column(2)
                .search(this.value)
                .draw();
        }
        if (table1.column(1).search() !== this.value) {
            table1
                .column(1)
                .search(this.value)
                .draw();
        }
    });
    $('#fecha').on('keyup change', function() {
        var fecha = moment(this.value);
        if (table.column(10).search() !== fecha.format("DD/MM/YYYY")) {
            table
                .column(10)
                .search(fecha.format("DD/MM/YYYY"))
                .draw();
        }

        if (table1.column(5).search() !== fecha.format("DD/MM/YYYY")) {
            table1
                .column(5)
                .search(fecha.format("DD/MM/YYYY"))
                .draw();
        }
    });

    $('#buscar').on('keyup', function() {
        table.search(this.value).draw();
    });

});

function limpiar() {
    document.getElementById("myForm").reset();
    clearInterval(ajaxCall);
}

$(document).ready(function() {

    $("#myForm").bind("submit", function() {
        // Capturamnos el boton de envío 

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            complete: function(data) {
                /*
                 * Se ejecuta al termino de la petición
                 * */
                $(".respuesta").html("Obteniendo Datos,por favor espere...");

            },
            success: function(data) {
                /*
                 * Se ejecuta cuando termina la petición y esta ha sido
                 * correcta
                 * */
                $(".respuesta").html(data);

                setInterval(ajaxCall, 10000);

                function ajaxCall() {

                    var dato = "orden=" + jQuery('#op').val();
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/OrdenProduccion.php',
                        data: dato,
                        success: function(data) {
                            $(".respuesta").html(data);

                        }
                    });

                }

            },
            error: function(data) {
                /*
                 * Se ejecuta si la peticón ha sido erronea
                 * */
                alert("Problemas al tratar de enviar el formulario");
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });
});
</script>

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">SUPERVISAR ACTIVIDADES Y TIEMPOS DE PARO DE LOS OPERADORES</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-dark" id="exampleModalLabel">FILTRAR INFORMACION</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="../ajax/OrdenProduccion.php" method="POST">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">FILTRAR POR CODIGO (OPERARIO)</label>
                            <input type="number" id="codigo" class="form-control"
                                title="Filtrar por codigo del operario">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">FILTRAR POR O.P</label>
                            <input type="text" id="op" name="orden" class="form-control"
                                title="Filtrar por orden de produccion">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">FILTRAR POR NOMBRE</label>
                            <input type="text" id="nombre" class="form-control" title="Filtrar por nombre del operario">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark">FILTRAR POR FECHA</label>
                            <input id="fecha" type="date" class="form-control" title="Filtrar por fecha">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="limpiar()">Limpiar</button>
                        <input type="submit" class="btn btn-primary" value="Aplicar filtro">
                    </div>

                </form>
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
                        <div class="form-group">{!! Form::label('cantidad', 'FILTRAR INFORMACION:') !!}</div>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-example-modal-lg">FILTRO AVANZADO</button>
                    </center>



                    <div class="form-group">
                        {!! Form::label('cantidad', 'BUSCAR POR CUALQUIER DATO:') !!}
                        <div id='update'> </div>
                        <input type="text" id="buscar" placeholder="INGRESE CUALQUIER TIPO DATO" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<center>
    <p class="respuesta"></p>
</center>
<span class="d-block p-2 bg-primary text-white">
    <center>
        <h3>INFORMACION DE ACTIVIDADES</h3>
    </center>
</span>
<div class="col-md-15">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="operador" class="display table table-striped table-hover">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID OPERADOR</th>
                            <th>NOMBRE DEL OPERADOR</th>
                            <th>NUMERO O.P</th>
                            <th>ACTIVIDAD</th>
                            <th>HORA ENTRADA</th>
                            <th>HORA SALIDA</th>
                            <th>CANTIDAD BUENAS</th>
                            <th>CANTIDAD MALAS</th>
                            <th>EFICIENCIA</th>
                            <th>EFICACIA</th>
                            <th>FECHA</th>
                        </tr>

                    </thead>
                    <?php
                         $serverName = "srv2008";
                         $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
                         $mysqli = sqlsrv_connect($serverName, $connectionInfo);
                         $sql_statement = "SELECT * FROM proyecto.operador";
                         $result = sqlsrv_query($mysqli, $sql_statement);
                         ?>


                    <tbody>
                        @foreach ($operador as $operadores)

                        <tr>
                            <td>{{$operadores->id}}</td>
                            <td>{{$operadores->nombre}}</td>
                            <td>{{$operadores->numero_op}}</td>
                            <td>{{$operadores->tarea}}</td>
                            <td>{{$operadores->hora_inicial}}</td>
                            <td>{{$operadores->hora_final}}</td>
                            <td>{{$operadores->cantidad}}</td>
                            <td>{{$operadores->cantidad_fallas}}</td>
                            <td>{{$operadores->eficencia}}</td>
                            <td>{{$operadores->eficacia}}</td>
                            <td>{{$operadores->inicial}}</td>
                            {!! Form::close() !!}
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>

<span class="d-block p-2 bg-primary text-white">
    <center>
        <h3>INFORMACION DE TIEMPOS DE PARO</h3>
    </center>
</span>
<div class="col-md-15">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="motivo" class="display table table-striped table-hover">


                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID DEL OPERADOR</th>
                            <th>NUMERO O.P</th>
                            <th>ACTIVIDAD</th>
                            <th>TIEMPO DESCANSO</th>
                            <th>CODIGO DESCANSO</th>
                            <th>MOTIVO DESCANSO</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($motivo as $motivos)

                        <tr>
                            <td>{{$motivos->id}}</td>
                            <td>{{$motivos->numero_op}}</td>
                            <td>{{$motivos->tarea}}</td>
                            <td>{{$motivos->tiempo_descanso}}</td>
                            <td>{{$motivos->code}}</td>
                            <td>{{$motivos->motivo_descanso}}</td>
                            <td>{{$motivos->fecha}}</td>
                            <td>{{$motivos->hora}}</td>
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