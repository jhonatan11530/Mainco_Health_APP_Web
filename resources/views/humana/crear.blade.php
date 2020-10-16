@extends('layout.plantilla')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<body onload="btn()">
     <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
               <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                         <h2 class="text-white pb-2 fw-bold">Crear Registro de ingreso a Gestion Humana</h2>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                         <a href="{{url('/humana')}}" class="btn btn-secondary btn-round">Atras</a>

                    </div>
               </div>
          </div>
     </div>

     <div class="page-inner mt--5">
          <div class="col mt--2">
               <div class="col-md-6 mx-auto">
                    <div class="card full-height">
                         <div class="card-body">
                              <div>
                                   <script>
                                        jQuery(document).ready(function($) {
                                             $('#Select').select2();
                                        });

                                        function addZero(i) {
                                             if (i < 10) {
                                                  i = "0" + i;
                                             }
                                             return i;
                                        }

                                        function entrada() {
                                             document.getElementById("botonentrada").disabled = true;
                                             var hoy = new Date();
                                             var hora = addZero(hoy.getHours()) + ":" + addZero(hoy.getMinutes()) + ":" + addZero(hoy.getSeconds());

                                             document.getElementById("HoraEntrada").value = hora;
                                        }

                                        function salida() {
                                             document.getElementById("botonsalida").disabled = true;
                                             var hoy = new Date();
                                             var hora = addZero(hoy.getHours()) + ":" + addZero(hoy.getMinutes()) + ":" + addZero(hoy.getSeconds());
                                             document.getElementById("HoraSalida").value = hora;
                                             diferencia();
                                        }

                                        function diferencia() {
                                             var motivo = document.getElementById("Motivo").value;
                                             var nombre = document.getElementById("Select").value;
                                             var inicio = document.getElementById("HoraEntrada").value;
                                             var fin = document.getElementById("HoraSalida").value;

                                             window.location.href = window.location.href + "?inicio=" + inicio + "&fin=" + fin + "&name=" + nombre + "&motivo=" + motivo;

                                        }

                                        function btn() {
                                             var asd = document.URL.indexOf("?inicio");
                                             if (asd == 49) {
                                                  document.getElementById("botonentrada").disabled = true;
                                                  document.getElementById("botonsalida").disabled = true;
                                             }
                                        }

                                        function countChars(obj) {
                                             var maxLength = 500;
                                             var strLength = obj.value.length;

                                             if (strLength > maxLength) {
                                                  document.getElementById("charNum").innerHTML = '<span style="color: red;">' + strLength + ' de ' + maxLength + ' Carácteres Maximo</span>';
                                             } else {
                                                  document.getElementById("charNum").innerHTML = strLength + ' de ' + maxLength + ' Carácteres Maximo';
                                             }
                                        }
                                   </script>
                                   <?php
                                   date_default_timezone_set('America/Bogota');
                                   if (isset($_REQUEST["inicio"]) && isset($_REQUEST["fin"]) && isset($_REQUEST["name"]) && isset($_REQUEST["motivo"])) {
                                        // asignar w1 y w2 a dos variables
                                        $phpVar1 = $_REQUEST["inicio"];
                                        $phpVar2 = $_REQUEST["fin"];
                                        $nombre = $_REQUEST["name"];
                                        $motivo = $_REQUEST["motivo"];

                                        $datetime1 = new DateTime($phpVar2);
                                        $datetime2 = new DateTime($phpVar1);
                                        $interval = $datetime1->diff($datetime2);
                                        $hora = $interval->format('%H:%I:%S');
                                   } else {
                                   }
                                   ?>
                                   {!! Form::open(['url' => 'humana', 'files' => true]) !!}


                                   <div class="form-group">
                                        {!! Form::label('cantidad', 'SELECCIONE EL PERSONAL :') !!}

                                        <select name="nombre" id="Select" class="form-control">
                                             <?php if (isset($nombre)) {
                                                  echo "<option value='" . $nombre . "' selected>" . $nombre . "</option>";
                                             } ?>
                                             <?php
                                             $serverName = "srv2008";
                                             $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
                                             $mysqli = sqlsrv_connect($serverName, $connectionInfo);
                                             $sql_statement = "SELECT DISTINCT nombre FROM operador";
                                             $result = sqlsrv_query($mysqli, $sql_statement);
                                             while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {


                                                  echo '<option value="' . $valores["nombre"] . '" >' . $valores["nombre"] . '</option>';
                                             }
                                             ?>

                                        </select>
                                   </div>


                                   <div class="form-group">
                                        {!! Form::label('cantidad', 'SELECCIONE EL MOTIVO :') !!}
                                        <select class="form-control" name="motivo" id="Motivo">
                                             <?php if (isset($motivo)) {
                                                  echo "<option value='" . $motivo . "' selected>" . $motivo . "</option>";
                                             } ?>
                                             <option value="DUDAS NOVEDADES NOMINA">DUDAS NOVEDADES NOMINA</option>
                                             <option value="SOLICITUD CERTIFI-LABORAL">SOLICITUD CERTIFI-LABORAL</option>
                                             <option value="LLAMADAS TELEFONICAS">LLAMADAS TELEFONICAS</option>
                                             <option value="AUTORIZACION DE PERMISOS">AUTORIZACION DE PERMISOS</option>
                                             <option value="ENTREGAR SOPORTE DE NOVEDADES">ENTREGAR SOPORTE DE NOVEDADES</option>
                                             <option value="CONSULTA A GH">CONSULTA A GH</option>
                                             <option value="REQUERIMIENTO DE GH">REQUERIMIENTO DE GH</option>
                                             <option value="REQUERIMIENTO DE SST">REQUERIMIENTO DE SST</option>
                                             <option value="ENFERMERIA">ENFERMERIA</option>
                                        </select>
                                   </div>

                                   <div class="form-group ">
                                        {!! Form::label('Codigo producto', 'HORA INGRESO :') !!}
                                        <div class="row">
                                             <div class="col">
                                                  <input type="text" name="inicial" value="<?php if (isset($phpVar1)) {
                                                                                                    echo $phpVar1;
                                                                                               } ?>" class="form-control" id="HoraEntrada" readonly>
                                             </div>
                                             <div class="col">
                                                  <button type="button" class="btn btn-primary" id="botonentrada" onclick="entrada()">REGISTRAR HORA</button>
                                             </div>
                                        </div>
                                   </div>


                                   <div class="form-group ">
                                        {!! Form::label('Codigo producto', 'HORA FINAL :') !!}
                                        <div class="row">
                                             <div class="col">
                                                  <input type="text" name="final" value="<?php if (isset($phpVar2)) {
                                                                                               echo $phpVar2;
                                                                                          } ?>" class="form-control" id="HoraSalida" readonly>
                                             </div>
                                             <div class="col">
                                                  <button type="button" class="btn btn-primary" id="botonsalida" onclick="salida()">REGISTRAR HORA</button>
                                             </div>
                                        </div>
                                   </div>




                                   <div class="form-group">
                                        {!! Form::label('Codigo producto', 'DIFERENCIA EN TIEMPO :') !!}
                                        <input type="text" name="tiempo" value="<?php if (isset($hora)) {
                                                                                     echo $hora;
                                                                                } ?>" class="form-control" style="text-align:center;" readonly />
                                   </div>

                                   <div class="form-group">
                                        {!! Form::label('Codigo producto', 'FECHA :') !!}
                                        <input type="text" name="fecha" value="<?php echo date("d/m/Y"); ?>" class="form-control" style="text-align:center;" readonly />
                                   </div>

                                   <div class="form-group">
                                        {!! Form::label('Codigo producto', 'OBSERVACIONES :') !!}
                                        <p id="charNum">0 Carácteres</p>
                                        <textarea onkeyup="countChars(this);" id="textarea" name="observacion" rows="6" cols="55" maxlength="500" placeholder="Escriba la Observacion"></textarea>
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
</body>
@stop