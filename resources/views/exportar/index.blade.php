@extends('layout/plantilla')
<script src="{{url('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" href="{{url('css/jquery.dataTables.min.css')}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@section('content')

<body onload="ValidarBOTTON()">

    <script>
    jQuery(document).ready(function($) {
        $('#Select').select2();
    });

    jQuery(document).ready(function($) {
        $('#OPERADOR').select2();
    });
    jQuery(document).ready(function($) {
        $('#OPERADORES').select2();
    });

    function valida() {
        document.getElementById("nameoperador").innerHTML = "";
        var paro = document.getElementById('paro').value;
        var paros = document.getElementById('paros').value;

        window.location.href = window.location.href + "?ini=" + paro + "&fin=" + paros;


    }


    function ValidarBOTTON() {


        // INFORME GENERAL POR OPERARIOS
        var rango = document.getElementById('rango').value;
        var rangos = document.getElementById('rangos').value;

        if (rango == "SELECCIONE RANGO DE FECHA INICIAL" && rangos == "SELECCIONE RANGO DE FECHA FINAL") {
            document.getElementById("Boton").disabled = true;

        }
        if (rango != "SELECCIONE RANGO DE FECHA INICIAL" && rangos != "SELECCIONE RANGO DE FECHA FINAL") {
            document.getElementById("Boton").disabled = false;

        }

        // INFORME DETALLADO + TIEMPO DE PARO
        var paro = document.getElementById('paro').value;
        var paros = document.getElementById('paros').value;

        if (paro == "SELECCIONE RANGO DE FECHA INICIAL" && paros == "SELECCIONE RANGO DE FECHA FINAL") {
            document.getElementById("validar").disabled = true;
            document.getElementById("Botonparo").disabled = true;
            document.getElementById("clear").style.display = "none";
        }
        if (paro != "SELECCIONE RANGO DE FECHA INICIAL" && paros != "SELECCIONE RANGO DE FECHA FINAL") {
            document.getElementById("validar").disabled = false;

            var URLsearch = window.location.search;
            if (URLsearch) {
                alert("SE HA FILTRADO LA INFORMACION");

                document.getElementById("validar").style.display = "none";
                document.getElementById("clear").style.display = "visible";

            }

        }


        // INFORME CONSOLIDADO 
        var operadores = document.getElementById('OPERADORES').value;

        if (operadores == "SELECCIONE EL OPERADOR") {
            document.getElementById("Botton").disabled = true;
        }
        if (operadores != "SELECCIONE EL OPERADOR") {
            document.getElementById("Botton").disabled = false;

        }

        // INFORME ERROR 
        var errormalo = document.getElementById('error').value;

        if (errormalo == "SELECCIONE LA FECHA QUE OCURRIO EL ERROR") {
            document.getElementById("ERRORES").disabled = true;
        }
        if (errormalo != "SELECCIONE LA FECHA QUE OCURRIO EL ERROR") {
            document.getElementById("ERRORES").disabled = false;

        }

        // INFORME GESTION HUMANA 
        var HUMANA = document.getElementById('GH').value;

        if (HUMANA == "SELECCIONE LA FECHA DE INGRESO A G.H") {
            document.getElementById("BTNGH").disabled = true;
        }
        if (HUMANA != "SELECCIONE LA FECHA DE INGRESO A G.H") {
            document.getElementById("BTNGH").disabled = false;

        }

    }
    </script>

    <div class="page-inner mt--5">
        <div class="col mt--4">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="table-responsive">

                            <div id="app">
                                @include('Mensaje')


                                @yield('content')
                            </div>

                            <table id="multi-filter-select" class="display table table-striped-bg-*states ">
                                @if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <div class="table-responsive">
                                    <tr>
                                        <th>EXPORTAR POR O.P VISUALIZAR ACTIVIDADES INDIVIDUALES</th>
                                        <th>EXPORTAR DATOS </th>
                                    </tr>

                                </thead>
                                <tbody>



                                    <tr>
                                        <?php
										$serverName = "srv2008";
										$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
										$mysqli = sqlsrv_connect($serverName, $connectionInfo);
										$sql_statement = "SELECT DISTINCT fecha FROM proyecto.promedio WHERE fecha is not null";
										$resultado = sqlsrv_query($mysqli, $sql_statement);
										$arreglito = array();
										while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

											$arreglito[] = $row["fecha"];
										}
										$serverName = "srv2008";
										$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
										$mysqli = sqlsrv_connect($serverName, $connectionInfo);
										$sql_statement = "SELECT DISTINCT fecha FROM proyecto.promedio WHERE fecha is not null";
										$resultado = sqlsrv_query($mysqli, $sql_statement);
										$arreglitos = array();
										while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

											$arreglitos[] = $row["fecha"];
										}


										?>

                                        <form action="../exportars.php" method="post">

                                            <td>

                                                <div class="form-group">
                                                    <select class="form-control" name="fechaUNO" id="rango"
                                                        onchange="ValidarBOTTON()">
                                                        <option selected="selected" disabled>SELECCIONE RANGO DE FECHA
                                                            INICIAL</option>
                                                        <?php foreach ($arreglito as $key) { ?>
                                                        <option name="fechaUNO"><?php echo $key; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <select class="form-control" name="fechaDOS" id="rangos"
                                                        onchange="ValidarBOTTON()">
                                                        <option selected="selected" disabled>SELECCIONE RANGO DE FECHA
                                                            FINAL</option>
                                                        <?php foreach ($arreglitos as $keys) { ?>
                                                        <option name="fechaDOS"><?php echo $keys; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <center>
                                                        <h3><b>CONDICION DE FILTRO</b></h3>
                                                    </center>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="radiobutton" value="86" required>
                                                    <label class="form-check-label">EFICIENCIA MAYOR 85%</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="radiobutton" value="85" required>
                                                    <label class="form-check-label">EFICIENCIA MENOR 85%</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="radiobutton" value="200" required>
                                                    <label class="form-check-label">TRAER TODO</label>
                                                </div>


                                            </td>

                                            <td>
                                                <button id="Boton" class="btn btn-primary" data-toggle="modal"
                                                    data-target=".bd-example-modal-lg">GENERAR INFORME <i
                                                        class="fas fa-cloud-download-alt"></i></button>
                                            </td>
                                            </td>
                                        </form>



                        </div>
                        </tbody>
                        @endif
                        @if ((Auth::user()->rol == 1) or (Auth::user()->rol == 2))
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>EXPORTAR INFORME DETALLADO POR OPERADOR</th>
                                <th>EXPORTAR DATOS </th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <?php
								if (isset($_REQUEST["ini"]) && isset($_REQUEST["fin"])) {
									$inicial = $_REQUEST["ini"];
									$final = $_REQUEST["fin"];
								}
								?>
                                <form action="../detallado.php" method="post">

                                    <td>

                                        <div class="form-group">
                                            <select class="form-control" name="fechaUNO" id="paro"
                                                onchange="ValidarBOTTON()">
                                                <?php if (isset($inicial)) {
													echo "<option value='" . $inicial . "' selected>" . $inicial . "</option>";
												} else {
													echo "<option selected disabled>SELECCIONE RANGO DE FECHA INICIAL</option>";
												} ?>

                                                <?php foreach ($arreglito as $key) { ?>
                                                <option name="fechaUNO"><?php echo $key; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="fechaDOS" id="paros"
                                                onchange="ValidarBOTTON()">
                                                <?php if (isset($final)) {
													echo "<option value='" . $final . "' selected>" . $final . "</option>";
												} else {
													echo "<option selected disabled>SELECCIONE RANGO DE FECHA FINAL</option>";
												} ?>
                                                <?php foreach ($arreglitos as $keys) { ?>
                                                <option name="fechaDOS"><?php echo $keys; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select name="nombre" id="nameoperador" class="form-control">
                                                <?php if (isset($inicial) && isset($final)) {

													$serverName = "srv2008";
													$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
													$mysqli = sqlsrv_connect($serverName, $connectionInfo);
													$sql_statement = "SELECT DISTINCT nombre FROM proyecto.operador WHERE inicial BETWEEN '" . $inicial . "' AND '" . $final . "'";
													$result = sqlsrv_query($mysqli, $sql_statement);
													while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {


														echo '<option value="' . $valores["nombre"] . '" selected>' . $valores["nombre"] . '</option>';
													}
												} else {
													echo "<option selected='selected' disabled>ESPERANDO FILTRO POR FECHA PARA MOSTRAR LOS OPERADORES</option>";
												} ?>

                                            </select>
                                        </div>


                    </div>


                </div>

                </td>

                <td>
                    <button id="Botonparo" class="btn btn-primary">GENERAR INFORME <i
                            class="fas fa-cloud-download-alt"></i></button><br><br>
                    </form>
                    <button id="validar" onclick="valida()" class="btn btn-primary">Validar Informacion</button>
                    <a href="http://192.168.20.9:8080/mainco/wps/exportar">
                        <button id="clear" class="btn btn-primary">LIMPIAR REGISTROS <i
                                class="fas fa-trash-alt"></i></button>
                    </a>
                </td>
                </td>

            </div>
            </tbody>

            <thead class="bg-primary text-white">
                <tr>
                    <th>EXPORTAR CONSOLIDADO POR OPERADOR</th>
                    <th>EXPORTAR DATOS </th>
                </tr>
            </thead>

            <tbody>



                <tr>
                    <?php
					$serverName = "srv2008";
					$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
					$mysqli = sqlsrv_connect($serverName, $connectionInfo);
					$sql_statement = "SELECT DISTINCT Descripcion FROM proyecto.promedio";
					$resultado = sqlsrv_query($mysqli, $sql_statement);
					$nombre = array();
					while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

						$nombre[] = $row["Descripcion"];
					}

					?>

                    <form action="../consolidado.php" method="post">

                        <td>
                            <div class="form-group">
                                <select class="form-control" name="nombre" id="OPERADORES" onchange="ValidarBOTTON()">
                                    <option selected="selected" disabled>SELECCIONE EL OPERADOR</option>
                                    <?php foreach ($nombre as $nom) { ?>
                                    <option name="nombre"><?php echo $nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>


        </div>


    </div>

    </td>

    <td>
        <button id="Botton" class="btn btn-primary">GENERAR INFORME <i class="fas fa-cloud-download-alt"></i></button>
    </td>
    </td>

    </form>

    </div>
    </tbody>
    @endif
    @if (Auth::user()->rol == 1)
    <thead class="bg-primary text-white">
        <tr>
            <th>EXPORTAR DATOS DE ERRORES</th>
            <th>EXPORTAR DATOS </th>
        </tr>
    </thead>

    <tbody>



        <tr>
            <?php
			$serverName = "srv2008";
			$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
			$mysqli = sqlsrv_connect($serverName, $connectionInfo);
			$sql_statement = "SELECT fecha FROM proyecto.error WHERE fecha is not null";
			$resultado = sqlsrv_query($mysqli, $sql_statement);
			$error = array();
			while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

				$error[] = $row["fecha"];
			}
			?>

            <form action="../error.php" method="post">

                <td>
                    <div class="form-group">
                        <select class="form-control" name="ERROR" id="error" onchange="ValidarBOTTON()">
                            <option selected="selected" disabled>SELECCIONE LA FECHA QUE OCURRIO EL ERROR</option>
                            <?php foreach ($error as $key) { ?>
                            <option name="errorfatal"><?php echo $key; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>

                <td>
                    <button id="ERRORES" class="btn btn-primary">GENERAR INFORME <i
                            class="fas fa-cloud-download-alt"></i></button>
                </td>
                </td>

            </form>

            </div>
    </tbody>
    @endif
    @if ((Auth::user()->rol == 1) or (Auth::user()->rol == 4))
    <thead class="bg-primary text-white">
        <tr>
            <th>EXPORTAR DATOS DE INGRESO A GESTION HUMANA</th>
            <th>EXPORTAR DATOS </th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <?php
			$serverName = "srv2008";
			$connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
			$mysqli = sqlsrv_connect($serverName, $connectionInfo);
			$sql_statement = "SELECT fecha FROM proyecto.gestion";
			$resultado = sqlsrv_query($mysqli, $sql_statement);
			$error = array();
			while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

				$error[] = $row["fecha"];
			}
			?>

            <form action="../gestion.php" method="post">

                <td>
                    <div class="form-group">
                        <select class="form-control" name="HUMANA" id="GH" onchange="ValidarBOTTON()">
                            <option selected="selected" disabled>SELECCIONE LA FECHA DE INGRESO A G.H</option>
                            <?php foreach ($error as $key) { ?>
                            <option><?php echo $key; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>

                <td>
                    <button id="BTNGH" class="btn btn-primary">GENERAR INFORME <i
                            class="fas fa-cloud-download-alt"></i></button>
                </td>
                </td>

            </form>

            </div>
    </tbody>
    @endif
    </table>

    </div>
    </div>
    </div>
    </div>
    </div>


</body>

@endsection