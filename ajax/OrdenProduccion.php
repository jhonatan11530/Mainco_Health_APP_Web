
    <?php
    date_default_timezone_set("America/Bogota");
    error_reporting(0);
    $dato = $_REQUEST["orden"];

    $serverName = 'srv2008';
    $connectionInfo = array('Database' => 'proyecto', 'UID' => 'proyecto', 'PWD' => '12345', 'CharacterSet' => 'UTF-8');
    $mysqli = sqlsrv_connect($serverName, $connectionInfo);
    $sql_statement = "SELECT SUM(cantidad) as cantidad FROM proyecto.operador WHERE numero_op = '" . $dato . "'";
    $result = sqlsrv_query($mysqli, $sql_statement);
    while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

        $cantioperario = $valores['cantidad'];
    }

    $sql_statement = "SELECT cantidad FROM proyecto.produccion WHERE numero_op = '" . $dato . "'";
    $result = sqlsrv_query($mysqli, $sql_statement);
    while ($produccion = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

        $cantiproduccion = $produccion['cantidad'];
    }

    $cantiporcentaje = round($cantioperario / $cantiproduccion * 100);


    if ($dato != '') {



        echo "<span class='d-block p-2 bg-primary text-white'>
                <center>
                    <h3>INFORMACION EN TIEMPO REAL DE LO PRODUCCIDO</h3>
                </center>
            </span>";

        echo "<center>
        <div class='col-md-6 mb-3'>
        <label class='font-weight-bold text-dark'>ACTUALIZADO HACE : " . date("h:i:s A") . " (HORA SUJETA AL SERVIDOR)</label>
        </div>
        <h2 class='mb-2'>NUMERO DE ORDEN DE PRODUCCION</h2>
        <div class='h1 fw-bold text-primary'>".$dato."</div>
        </center>";

        echo "<div class='row'>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-primary'>" . $cantiporcentaje . "%</div>
                    <h2 class='mb-2'>Porcentaje Completado</h2>
                    <p class='text-muted'>total completado de la O.P</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-danger'> ". $cantiproduccion . "</div>
                    <h2 class='mb-2'>Total En O.P</h2>
                    <p class='text-muted'>cantidad en orden de produccion</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart2'></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-warning'>". $cantioperario . "</div>
                    <h2 class='mb-2'>Total Produccido</h2>
                    <p class='text-muted'>total cantidad produccido por operario</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart3'></div>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    } else {


        echo "<span class='d-block p-2 bg-primary text-white'>
                <center>
                    <h3>INFORMACION EN TIEMPO REAL DE LA ORDEN DE PRODUCCION</h3>
                </center>
            </span>";

        echo "<div class='row'>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-primary'>0%</div>
                    <h2 class='mb-2'>Porcentaje Completado</h2>
                    <p class='text-muted'>total completado de la O.P</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-danger'>0</div>
                    <h2 class='mb-2'>Total En O.P</h2>
                    <p class='text-muted'>cantidad en orden de produccion</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart2'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='card'>
                <div class='card-body pb-0'>
                    <div class='h1 fw-bold float-right text-warning'>0</div>
                    <h2 class='mb-2'>Total Produccido</h2>
                    <p class='text-muted'>total cantidad produccido por operario</p>
                    <div class='pull-in sparkline-fix'>
                        <div id='lineChart3'></div>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
