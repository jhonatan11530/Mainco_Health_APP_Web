@extends('layout.plantilla')
@section('content')

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Crear Usuarios</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="{{url('/usuarios')}}" class="btn btn-secondary btn-round">Atras</a>

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

                        <body onload="ejecutar()">
                            <script>
                            function ejecutar() {
                                var texto = document.getElementById('Seleccion').value;


                                if (texto == 1) {
                                    document.getElementById('up').innerHTML =
                                        '<input name="cargo" type="hidden" value="administrador" class="form-control" required>';
                                } else if (texto == 2) {
                                    document.getElementById('up').innerHTML =
                                        '<input name="cargo" type="hidden" value="analista" class="form-control" required>';
                                } else if (texto == 3) {
                                    document.getElementById('up').innerHTML =
                                        '<input name="cargo" type="hidden" value="operador" class="form-control" required>';
                                } else {
                                    document.getElementById('up').innerHTML =
                                        '<input name="cargo" type="hidden" value="Gestion humana" class="form-control" required>';
                                }



                            }
                            </script>
                            {!! Form::open(['url' => 'usuarios', 'files' => true]) !!}
                            <div class="form-group">

                                {!! Form::label('Nombre', 'Nombre:') !!}
                                {!! Form::text('nomusuario',null,['class' => 'form-control', 'required' => 'required'])
                                !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Apellido', 'Apellido:') !!}
                                {!! Form::text('apeusuario',null,['class' => 'form-control', 'required' => 'required'])
                                !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Email', 'Codigo unico:') !!}
                                {!! Form::text('cedula',null,['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Contraseña', 'Contraseña:') !!}
                                <input name="password" type="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                {!! Form::label('cantidad', 'Selecione el cargo del usuario:') !!}

                                <select name="rol" id="Seleccion" class="form-control" onchange="ejecutar()">
                                    <?php
                                             $serverName = "srv2008";
                                             $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
                                             $mysqli = sqlsrv_connect($serverName, $connectionInfo);
                                             $sql_statement = "SELECT * FROM roles";
                                             $result = sqlsrv_query($mysqli, $sql_statement);
                                             while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

                                                  echo '<option value="' . $valores["id"] . '" >' . $valores["cargo"] . '</option>';
                                             }

                                             ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <div id="up"></div>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                    </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
    @stop