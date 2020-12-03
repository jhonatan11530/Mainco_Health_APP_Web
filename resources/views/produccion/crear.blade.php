@extends('layout.plantilla')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Orden de produccion</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{url('/produccion')}}" class="btn btn-secondary btn-round">Atras</a>

            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="col mt--2">
        <div class="col-md-6 mx-auto">
            <div class="card full-height">
                <div class="card-body">

                    <script>
                    function validar() {
                        var text = document.getElementById("Select").value;

                        console.info(text);
                        var texto = parseInt(text)
                        window.location.href = "http://192.168.20.9:8080/mainco/wps/produccion/" + text + "/now";
                    }

                    jQuery(document).ready(function($) {
                        $('#Select').select2();
                    });
                    </script>


                    <div>
                        {!! Form::open(['url' => 'produccion', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('Nombre', 'Asignar numero op :') !!}
                            <input class="form-control" value="DEBE SELECCIONAR EL ITEM PRIMERO" readonly />


                        </div>
                        <div class="form-group">
                            {!! Form::label('Codigo producto', 'Codigo Item :') !!}

                            <select class="form-control" name="cod_producto" id="Select" onchange="validar()">
                                <option selected="true" disabled="disabled">SELECCIONE UNA OPCION</option>
                                <?php
                                        $serverName = "srv2008";
                                        $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
                                        $mysqli = sqlsrv_connect($serverName, $connectionInfo);
                                        $sql_statement = "SELECT DISTINCT cod_producto FROM proyecto.produccion ORDER BY cod_producto ASC";
                                        $result = sqlsrv_query($mysqli, $sql_statement);
                                        while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                             echo '<option>' . $valores["cod_producto"] . '</option>';
                                        }
                                        ?>
                            </select>


                        </div>

                        <div class="form-group">
                            {!! Form::label('Codigo producto', 'Descripcion del producto :') !!}
                            <input type="text" name="descripcion" class="form-control" value="DEBE SELECCIONAR EL ITEM PRIMERO" readonly />
                        </div>

                        <div class="form-group">
                            {!! Form::label('cantidad', 'Cantidad:') !!}
                            <input type="text" name="cantidad" class="form-control" value="DEBE SELECCIONAR EL ITEM PRIMERO" readonly/>
                        </div>






                        <div class="form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop