<?php
echo $dato = $_REQUEST["orden"];
$serverName = 'srv2008';
$connectionInfo = array('Database' => 'proyecto', 'UID' => 'proyecto', 'PWD' => '12345', 'CharacterSet' => 'UTF-8');
$mysqli = sqlsrv_connect($serverName, $connectionInfo);
$sql_statement = 'SELECT SUM(cantidad) as cantidad FROM proyecto.operador ';
$result = sqlsrv_query($mysqli, $sql_statement);
while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

    $cantioperario = $valores['cantidad'];
}
$mysqli = sqlsrv_connect($serverName, $connectionInfo);
$sql_statement = "SELECT SUM(cantidad) as cantidad FROM proyecto.produccion";
$result = sqlsrv_query($mysqli, $sql_statement);
while ($produccion = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

    $cantiproduccion = $produccion["cantidad"];
}
$cantiporcentaje = round($cantioperario / $cantiproduccion * 100);

?>
	
    <div class="row">
    <div class='col-md-4'>
        <div class='card'>
            <div class='card-body pb-0'>
                <div class='h1 fw-bold float-right text-primary'><?php if (isset($cantiporcentaje)) {
                                                                        echo $cantiporcentaje;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?>%</div>
                <h2 class='mb-2'>Porcentaje Completado</h2>
                <p class='text-muted'>total completado de la O.P</p>
                <div class='pull-in sparkline-fix'>
                    <div id='lineChart'></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right text-danger"><?php if (isset($cantiproduccion)) {
                                                                    echo $cantiproduccion;
                                                                } else {
                                                                    echo 0;
                                                                } ?></div>
                <h2 class="mb-2">Total En O.P</h2>
                <p class="text-muted">cantidad en orden de produccion</p>
                <div class="pull-in sparkline-fix">
                    <div id="lineChart2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body pb-0">
                <div class="h1 fw-bold float-right text-warning"><?php if (isset($cantioperario)) {
                                                                        echo $cantioperario;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?></div>
                <h2 class="mb-2">Total Produccido</h2>
                <p class="text-muted">total cantidad produccido por operario</p>
                <div class="pull-in sparkline-fix">
                    <div id="lineChart3"></div>
                </div>
            </div>
        </div>
    </div>
</div>