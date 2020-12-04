
    <?php

      function Server()
      {
         $serverName = "srv2008,1433";
         return $serverName;
      }
      function connectionInfo()
      {
         $connectionInfo = array("Database" => "proyecto", "UID" => "proyecto", "PWD" => "12345", "CharacterSet" => "UTF-8");
         return $connectionInfo;
      }

      date_default_timezone_set('America/Bogota');
      error_reporting(0);

      $orden = $_REQUEST["numero_op"];
      $code = $_REQUEST["cod_producto"];
      $descripcion = $_REQUEST["descripcion"];
      $cantidad = $_REQUEST["cantidad"];
      $programadas = $_REQUEST["programadas"];
      $autorizado = $_REQUEST["autorizado"];

   
      $mysqli = sqlsrv_connect(Server(), connectionInfo());
      $produccion = "INSERT INTO proyecto.produccion(numero_op,cod_producto,descripcion,cantidad,programadas,autorizado)
      VALUES('" . $orden . "','" . $code . "','" . $descripcion . "','" . $cantidad . "','" . $programadas . "','" . $autorizado . "')";
      sqlsrv_query($mysqli, $produccion);

      // ID
      $sql_statement = "SELECT * FROM proyecto.tarea WHERE id='" . $code . "' AND numero_op IS NULL ";
      $result = sqlsrv_query($mysqli, $sql_statement);

      while ($valores = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

         $ids[] = $valores['id'];
         $tareas[] = $valores['tarea'];
         $cantidadbases[] = $valores['cantidadbase'];
         $extandars[] = number_format((float)$valores['extandar'], 8, '.', '');
      }
      for ($i = 0; $i < count($ids); $i++) {
          $id = $ids[$i];
          $tarea = $tareas[$i];
          $cantidadbase = $cantidadbases[$i];
          $extandar =  $extandars[$i];

         $mysqli = sqlsrv_connect(Server(), connectionInfo());
         $sql_consulta = "INSERT INTO proyecto.tarea(numero_op,id,tarea,cantidadpentiente,cantidadbase,extandar) 
        VALUES('" . $orden . "','" . $id . "','" . $tarea . "',0,'" . $cantidadbase . "','" . $extandar . "')";
         $result = sqlsrv_query($mysqli, $sql_consulta);
      }
      

    header("Location: http://192.168.20.9:8080/mainco/wps/produccion");
