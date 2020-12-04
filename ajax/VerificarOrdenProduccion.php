
    <?php
    date_default_timezone_set('America/Bogota');

     $dato = $_REQUEST['verificar'];

    $serverName = '192.168.20.9';
    $connectionInfo = array('Database' => 'proyecto', 'UID' => 'proyecto', 'PWD' => '12345', 'CharacterSet' => 'UTF-8');
    $mysqli = sqlsrv_connect($serverName, $connectionInfo);
    $sql_statement = "SELECT numero_op FROM proyecto.produccion WHERE numero_op =  '" . $dato . "' ";
    $result = sqlsrv_query($mysqli, $sql_statement);
    while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

        $verificador = $valores['numero_op'];
    }

        if (isset($verificador)) {
            echo "<h4><strong>NO DISPONIBLE !!</strong></h4>";
            echo '<div class="alert alert-danger">
            <strong><i class="fas fa-times"></i> LA ORDEN DE PRODUCCION '.$dato.' YA EXISTE DEBE INGRESAR OTRO NUMERO DE ORDEN DE PRODUCCION</strong>
            </div>';
            echo '<script>document.getElementById("envio").disabled = true;</script>';
           
        }else{
        echo "<h4><strong>DISPONIBLE</strong></h4>";
        echo '<div class="alert alert-success">
        <strong><i class="fas fa-check-circle"></i> LA ORDEN DE PRODUCCION '.$dato.' ESTA DISPOBILE<br>CREE LA ORDEN DE PRODUCCION</strong>
        </div>';
        echo '<script>document.getElementById("envio").disabled = false;</script>';
        }


 
   