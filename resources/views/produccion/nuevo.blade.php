@extends('layout.plantilla')
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>

            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{url('/produccion')}}" class="btn btn-secondary btn-round">Atras</a>

            </div>
        </div>
    </div>
</div>

<style>
.without_ampm::-webkit-datetime-edit-ampm-field {
    display: none;
}

input[type=time]::-webkit-clear-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    -o-appearance: none;
    -ms-appearance: none;
    appearance: none;
    margin: -10px;
}
</style>

<script>
function enviarajax(dato, orden) {

    var parametros = {
        dato,
        orden
    };
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: parametros,
        error: function(data) {
            /*
             * Se ejecuta si la peticón ha sido erronea
             * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });
}

function variable() {
    document.getElementById("variable2").value = document.getElementById("variable1").value;
}

function SQL() {
    var x = document.getElementById("op").value;
    console.log(x);

    $.ajax({
        type: 'GET',
        url: '../../../ajax/VerificarOrdenProduccion.php',
        data: "verificar=" + x,
        success: function(data) {
            /*
             * Se ejecuta cuando termina la petición y esta ha sido
             * correcta
             * */
            $(".respuesta").html(data);

        },
        error: function(data) {
            /*
             * Se ejecuta si la peticón ha sido erronea
             * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });
}
</script>
<?php

$serverName = "srv2008";
$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
$mysqli = sqlsrv_connect($serverName, $connectionInfo);
$sql_statement = "SELECT MAX(id)+1 as id FROM proyecto.produccion";
$result = sqlsrv_query($mysqli, $sql_statement);
while ($e = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
     $salida = $e["id"];
}

?>
<div class="page-inner mt--5">
    <div class="col mt--2">
        <div class="col-md-6 mx-auto">
            <div class="card full-height">
                <div class="card-body">
                    <p class="respuesta"></p>
                    <form id="myForm" action="../../../ajax/InsertTarea.php" method="GET">

                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id" value="<?php echo $salida; ?>"
                                readonly />
                        </div>

                        <div class="form-group">
                            {!! Form::label('Asignar numero op', 'Asignar numero op :') !!}
                            <input class="form-control" id="op" onchange="SQL()" name="numero_op" required />

                        </div>

                        <div class="form-group">
                            {!! Form::label('Codigo Item ', 'Codigo Item :') !!}
                            <input class="form-control" id="cod" type="text" name="cod_producto"
                                value="{{$produccion->cod_producto}}" readonly />
                        </div>

                        <div class="form-group">
                            {!! Form::label('descripcion del producto ', 'Descripcion del producto :') !!}
                            <input class="form-control" type="text" name="descripcion"
                                value="{{$produccion->descripcion}}" readonly />
                        </div>

                        <div class="form-group">
                            {!! Form::label('cantidad', 'Cantidad:') !!}
                            <input class="form-control" type="text" id="variable1" name="cantidad" onchange="variable()" required />
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="hidden" id="variable2" name="autorizado" required />
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="programadas" value="08:00:00" class="form-control" required />
                        </div>



                        <input type="submit" class="form-control btn btn-primary" id="envio" value="CREAR ORDEN DE PRODUCCION">

                    </form>



                </div>
            </div>
        </div>
    </div>
    @stop