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
<div class="page-inner mt--5">
     <div class="col mt--2">
          <div class="col-md-6 mx-auto">
               <div class="card full-height">
                    <div class="card-body">


                         {!! Form::open(['url' => 'produccion', 'files' => true]) !!}
                         <script>
                              function variable() {
                                   document.getElementById("variable2").value = document.getElementById("variable1").value;
                              }
                         </script>
                         <?php
                         $serverName = "srv2008";
                         $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
                         $mysqli = sqlsrv_connect($serverName, $connectionInfo);
                         $sql_statement = "SELECT MAX(id) FROM proyecto.produccion";
                         $result = sqlsrv_query($mysqli, $sql_statement);
                         while ($e = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                              $salida = $e;
                         }

                         ?>

                         <div class="form-group">
                              <input class="form-control" type="hidden" name="id" value="{{$produccion->autoincrement}}" readonly />
                         </div>

                         <div class="form-group">
                              {!! Form::label('Asignar numero op', 'Asignar numero op :') !!}
                              <input class="form-control" name="numero_op" required />

                         </div>

                         <div class="form-group">
                              {!! Form::label('Codigo Item ', 'Codigo Item :') !!}
                              <input class="form-control" type="text" name="cod_producto" value="{{$produccion->cod_producto}}" readonly />
                         </div>

                         <div class="form-group">
                              {!! Form::label('descripcion del producto ', 'Descripcion del producto :') !!}
                              <input class="form-control" type="text" name="descripcion" value="{{$produccion->descripcion}}" readonly />
                         </div>

                         <div class="form-group">
                              {!! Form::label('cantidad', 'Cantidad:') !!}
                              <input class="form-control" type="text" id="variable1" name="cantidad" onchange="variable()" require />
                         </div>

                         <div class="form-group">
                              <input class="form-control" type="hidden" id="variable2" name="autorizado" require />
                         </div>
                         <div class="form-group">
                              <input type="hidden" name="programadas" value="08:00:00" class="form-control" require />
                         </div>

                         <div class="form-group">
                              {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                         </div>
                         {!! Form::close() !!}

                    </div>
               </div>
          </div>
     </div>
     @stop