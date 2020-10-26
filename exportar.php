<?php
require_once("ConexionSQL.php");
require_once 'PHPExcel.php';
error_reporting(0);

$Radio = $_POST["radiobutton"];
$fechainicial = $_POST['fechaUNO'];
$fechafinal = $_POST['fechaDOS'];


if ($Radio == 86 && isset($fechainicial) && isset($fechafinal)) {

  $mysqli = sqlsrv_connect(Server(), connectionInfo());
  $consulta = "SELECT * FROM proyecto.promedio WHERE fecha BETWEEN '" . $fechainicial . "' AND '" . $fechafinal . "' AND eficiencia > 85 ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $consulta);



  $objPHPExcel = new PHPExcel();
  $fila = 6;


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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL ' . $fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL ' . $fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'HORA');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('H5', '% PRODUC');

  while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

    $fecha = $row['fecha'];
    $hora = $row['hora'];
    $Descripcion = $row['Descripcion'];
    $tiempo_habil = $row['tiempo_habil'];
    $timepo_estimado = $row['timepo_estimado'];
    $tiempo_produccido = $row['tiempo_produccido'];
    $eficiencia = $row['eficiencia'];
    $produccion = $row['produccion'];

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $hora);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $produccion);

    $fila++;
  }

  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE ' . $fechainicial . ' AL ' . $fechafinal . ' EFICIENCIA MAYOR AL 85%.xlsx"');

  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');

  exit;
}

if ($Radio == 85 && isset($fechainicial) && isset($fechafinal)) {

  $mysqli = sqlsrv_connect(Server(), connectionInfo());
  $consulta = "SELECT * FROM proyecto.promedio WHERE fecha BETWEEN '" . $fechainicial . "' AND '" . $fechafinal . "' AND eficiencia < 85 ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $consulta);

 

  $objPHPExcel = new PHPExcel();
  $fila1 = 6;


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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL ' . $fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL ' . $fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'HORA');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('H5', '% PRODUC');

  while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

    $fecha = $row['fecha'];
    $hora = $row['hora'];
    $Descripcion = $row['Descripcion'];
    $tiempo_habil = $row['tiempo_habil'];
    $timepo_estimado = $row['timepo_estimado'];
    $tiempo_produccido = $row['tiempo_produccido'];
    $eficiencia = $row['eficiencia'];
    $produccion = $row['produccion'];

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila1, $fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila1, $hora);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila1, $Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila1, $tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila1, $timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila1, $tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila1, $eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila1, $produccion);

    $fila1++;
  }

  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE ' . $fechainicial . ' AL ' . $fechafinal . ' EFICIENCIA MENOR AL 85%.xlsx"');

  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');

  exit;
}
if ($Radio == 200 && isset($fechainicial) && isset($fechafinal)) {
  $mysqli = sqlsrv_connect(Server(), connectionInfo());
  $consulta = "SELECT * FROM proyecto.promedio WHERE fecha BETWEEN '" . $fechainicial . "' AND '" . $fechafinal . "' ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $consulta);


  $fechast3 = count($fechas3);
  $objPHPExcel = new PHPExcel();
  $fila2 = 6;

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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL ' . $fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL ' . $fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'HORA');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('H5', '% PRODUC');

  while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

    $fecha = $row['fecha'];
    $hora = $row['hora'];
    $Descripcion = $row['Descripcion'];
    $tiempo_habil = $row['tiempo_habil'];
    $timepo_estimado = $row['timepo_estimado'];
    $tiempo_produccido = $row['tiempo_produccido'];
    $eficiencia = $row['eficiencia'];
    $produccion = $row['produccion'];

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila2, $fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila2, $hora);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila2, $Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila2, $tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila2, $timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila2, $tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila2, $eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila2, $produccion);
    $fila2++;
  }


  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE' . $fechainicial . ' AL ' . $fechafinal . ' EFICIENCIA GENERAL.xlsx"');

  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');/* */

  exit;
}
if (isset($fechainicial) && isset($fechafinal)) {
  echo '<script type="text/javascript">
  alert("NO HAY REGISTRO DE LOS DATOS SELECCIONADOS");
  window.location.assign("http://192.168.20.9:8080/mainco/wps/exportar");
  </script>';
}
