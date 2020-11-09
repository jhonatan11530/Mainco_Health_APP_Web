<?php
require_once("ConexionSQL.php");
require_once 'PHPExcel.php';
error_reporting(0);

$fechainicial = $_POST['fechaUNO'];
$fechafinal = $_POST['fechaDOS'];
$nombre = $_POST['nombre'];

$SQL = sqlsrv_connect(Server() , connectionInfo());

$conn = "SELECT * FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN'".$fechainicial."' AND '".$fechafinal."' ORDER BY numero_op DESC";
$resultado = sqlsrv_query($SQL, $conn);

$sql_consulta = "SELECT  DISTINCT nombre FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN '".$fechainicial."' AND '".$fechafinal."'";
$resultt = sqlsrv_query($SQL, $sql_consulta);

$consulta = "SELECT  id FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN '".$fechainicial."' AND '".$fechafinal."'";
$filtro = sqlsrv_query($SQL, $consulta);
while ($row = sqlsrv_fetch_array($filtro,SQLSRV_FETCH_ASSOC)){ 
  $id =  $row['id'];
   }
/**/
   $ORDEN = "SELECT numero_op FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN'".$fechainicial."' AND '".$fechafinal."' ORDER BY numero_op DESC";
$resultadoORDEN = sqlsrv_query($SQL, $ORDEN);
while ($row = sqlsrv_fetch_array($resultadoORDEN,SQLSRV_FETCH_ASSOC)){ 
  $ORDEN_DE_PRODUCCION =  $row['numero_op']; 
   }

   $search = "SELECT operador.cantidad,operador.tarea as tarea,cantidadbase, extandar
    FROM proyecto.produccion INNER JOIN proyecto.tarea ON proyecto.produccion.cod_producto = proyecto.tarea.id  INNER JOIN proyecto.operador ON proyecto.operador.tarea = proyecto.tarea.tarea
      WHERE proyecto.operador.inicial='".$fechainicial."' AND proyecto.operador.nombre='".$nombre."' AND proyecto.produccion.numero_op='".$ORDEN_DE_PRODUCCION."' AND proyecto.tarea.numero_op='".$ORDEN_DE_PRODUCCION."'";
    $res = sqlsrv_query($SQL, $search);  
  
    while($listo = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
     $cant[] = $listo["cantidad"];
      $extandar[] = $listo["extandar"]; 

      $real[]= round($listo["extandar"] *60) / $listo["cantidadbase"];
    }

    for ($i=0; $i < count($cant); $i++) { 

       $array[] =  $real[$i] / $cant[$i];
    }
     $cantidadorden = array_sum($array);


$consultaSUM = "SELECT SUM(cantidad) as cantidad FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN'".$fechainicial."' AND '".$fechafinal."'";
$totaleficiencia = sqlsrv_query($SQL, $consultaSUM);
while ($row = sqlsrv_fetch_array($totaleficiencia,SQLSRV_FETCH_ASSOC)){ 
  $cantidad =  $row['cantidad'];

   }
   $tiemposecond = $cantidad * $cantidadorden;

$consult = "SELECT * FROM proyecto.motivo_paro WHERE id='".$id."' AND fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."'";
$result = sqlsrv_query($SQL, $consult);

$sql_statement = "SELECT numero_op,hora_inicial,hora_final FROM proyecto.operador WHERE nombre='".$nombre."' AND inicial BETWEEN '".$fechainicial."' AND '".$fechafinal."'";
$verificar = sqlsrv_query($SQL, $sql_statement);
while ($row = sqlsrv_fetch_array($verificar,SQLSRV_FETCH_ASSOC)){ 
  $op =  $row['numero_op'];
   }


$sum_paro = "SELECT SUM(DATEDIFF(SECOND, '00:00:00', CONVERT(time, tiempo_descanso))) AS tiempo_descanso FROM proyecto.motivo_paro WHERE id='".$id."' AND fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."'";
$ensayo = sqlsrv_query($SQL, $sum_paro);

$fechas = "SELECT hora_inicial,hora_final FROM proyecto.operador WHERE nombre='".$nombre."'  AND inicial BETWEEN '".$fechainicial."' AND '".$fechafinal."' ";
$fecha = sqlsrv_query($SQL, $fechas);

$estiman = "SELECT timepo_estimado FROM proyecto.promedio WHERE Descripcion='".$nombre."' AND fecha='".$fechainicial."'  ";
$estimando = sqlsrv_query($SQL, $estiman);

$sumfechas = "SELECT SUM(DATEDIFF(SECOND,hora_inicial,hora_final)) AS total FROM proyecto.operador WHERE nombre='".$nombre."'  AND inicial BETWEEN '".$fechainicial."' AND '".$fechafinal."' ";
$sumardiferencia = sqlsrv_query($SQL, $sumfechas);

$sql_statement = "SELECT cod_producto FROM proyecto.produccion WHERE numero_op='".$op."'";
$numeroop = sqlsrv_query($SQL, $sql_statement);
while ($row = sqlsrv_fetch_array($numeroop,SQLSRV_FETCH_ASSOC)){ 
  $NUMEROOP =  $row['cod_producto'];
   }

$objPHPExcel = new PHPExcel();
$fila =6;
$filas =7;
$actividad =10;
$diferencia=10;
$paro=10;

$objPHPExcel->getProperties()

->setCreator("Cattivo")

->setLastModifiedBy("Cattivo")

->setTitle("Documento Excel de Prueba")

->setSubject("Documento Excel de Prueba")

->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")

->setKeywords("Excel Office 2007 openxml php")

->setCategory("Pruebas de Excel");

 

$objPHPExcel->setActiveSheetIndex(0);

// INFORMACION DEL OPERADOR
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'MAINCO HEALTH CARE');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'FECHA INICIAL '.$fechainicial);
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'FECHA FINAL '.$fechafinal);
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NOMBRE DEL OPERADOR');
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'NUMERO O.P');
$objPHPExcel->getActiveSheet()->setCellValue('B9', 'NUMERO ITEM');
$objPHPExcel->getActiveSheet()->setCellValue('G9', 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('C9', 'ACTIVIDADES DE LA O.P');
$objPHPExcel->getActiveSheet()->setCellValue('H9', 'EFICIENCIA INDIVIDUAL');
$objPHPExcel->getActiveSheet()->setCellValue('J9', 'TIEMPO PRODUCCIDO');
$objPHPExcel->getActiveSheet()->setCellValue('J6', 'TIEMPO TOTAL HABIL');
$objPHPExcel->getActiveSheet()->setCellValue('K6', 'TIEMPO TOTAL PRODUCCIDO');
$objPHPExcel->getActiveSheet()->setCellValue('L6', 'TOTAL TIEMPO DE PARO');
$objPHPExcel->getActiveSheet()->setCellValue('H6', 'TIEMPO TOTAL ESTIMADO');

$objPHPExcel->getActiveSheet()->setCellValue('F6', 'EFICIENCIA TOTAL');


while ($row = sqlsrv_fetch_array($filtro,SQLSRV_FETCH_ASSOC)){ 
  $cantidad =  $row['cantidad'];
  $objPHPExcel->getActiveSheet()->setCellValue('F6' ,strval($cantidad) );
   }
while($row = sqlsrv_fetch_array($ensayo, SQLSRV_FETCH_ASSOC)) {
  $TIMEPAROSUM= $row["tiempo_descanso"] ; 

  $promedioSUM = gmdate('H:i:s', $TIMEPAROSUM);
 $objPHPExcel->getActiveSheet()->setCellValue('l7' ,strval($promedioSUM) );
}  

while($row = sqlsrv_fetch_array($estimando, SQLSRV_FETCH_ASSOC)) {
  $estimado= $row["timepo_estimado"] ; 
 
  $estimados = gmdate('H:i:s', $estimado);
  $objPHPExcel->getActiveSheet()->setCellValue('H7' ,$estimado);

} 
while ($row = sqlsrv_fetch_array($resultt,SQLSRV_FETCH_ASSOC)){ 
  
  $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila ,strval($row['nombre']) );

    $fila++;

  }

  while ($row = sqlsrv_fetch_array($sumardiferencia,SQLSRV_FETCH_ASSOC)){ 
  
     $totalfechas =  $row['total'];
      $real =gmdate("H:i:s", $totalfechas);


                 // TIEMPO DIFERENCIA
                 list($hours, $minutes, $segund) = explode(':', $real);
                 $timeprogramado = ($hours * 3600 ) + ($minutes * 60 ) + $segund;
             // TIEMPO REAL LABORADO
             list($hours, $minutes, $segund) = explode(':', $promedioSUM);
             $timeproduccido = ($hours * 3600 ) + ($minutes * 60 ) + $segund;
             
             
             $habil = $timeprogramado - $timeproduccido;
             
              $habiles = gmdate('H:i:s', $habil);
             $EFICIENCIA_TOTAL = round($tiemposecond / $habil * 100);

           $objPHPExcel->getActiveSheet()->setCellValue('K'.$filas ,$habiles);

           $objPHPExcel->getActiveSheet()->setCellValue('F7' ,$EFICIENCIA_TOTAL."%");

    $objPHPExcel->getActiveSheet()->setCellValue('J'.$filas ,$real);
      $filas++;

    }

  while ($row = sqlsrv_fetch_array($fecha,SQLSRV_FETCH_ASSOC)){

     $datetime1 = new DateTime($row["hora_final"]->format('H:i:s'));
     $datetime2 = new DateTime($row["hora_inicial"]->format('H:i:s'));
     $interval = $datetime1->diff($datetime2);
     $hora = $interval->format('%H:%I:%S');

      $objPHPExcel->getActiveSheet()->setCellValue('J'.$diferencia ,$hora );

     $diferencia++;
     }

while ($row = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){ 

  $objPHPExcel->getActiveSheet()->setCellValue('A'.$actividad ,strval($row['numero_op']) );
  $objPHPExcel->getActiveSheet()->setCellValue('G'.$actividad ,strval($row['cantidad']) );
  $objPHPExcel->getActiveSheet()->setCellValue('B'.$actividad ,strval($NUMEROOP) );

  $objPHPExcel->getActiveSheet()->setCellValue('C'.$actividad ,strval($row['tarea']) );
  $objPHPExcel->getActiveSheet()->setCellValue('H'.$actividad ,strval($row['eficencia'])."%");

    $actividad++;
  }


// TIEMPO DE PAROS
$objPHPExcel->getActiveSheet()->setCellValue('L9', 'CODIGO DE PARO');
$objPHPExcel->getActiveSheet()->setCellValue('M9', 'TIEMPO DE PARO');
$objPHPExcel->getActiveSheet()->setCellValue('N9', 'NOMBRE MOTIVO PARO');

while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$paro ,strval($row['code']) );
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$paro ,strval($row['tiempo_descanso'] ));
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$paro ,strval($row['motivo_descanso'] ));
      $paro++;
    }

$objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="INFORME '.$nombre.' FECHA '.$fechainicial.' AL '.$fechafinal.'.xlsx"');

header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');


exit; /*
*/