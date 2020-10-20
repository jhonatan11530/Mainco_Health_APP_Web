<?php
require_once("ConexionSQL.php");
error_reporting(0);
require_once 'PHPExcel.php';
$nombre = $_REQUEST['nombre'];


$mysqli = sqlsrv_connect(Server(), connectionInfo());
$sql_statement = "SELECT DISTINCT Descripcion FROM proyecto.promedio WHERE Descripcion = '" . $nombre . "'  ";
$resultado = sqlsrv_query($mysqli, $sql_statement);
while ($row = sqlsrv_fetch_array($resultado)) {

  $name = $row["Descripcion"];
}

if ($name == null) {

  echo '<script type="text/javascript">
  alert("NO HAY REGISTRO DE LOS DATOS SELECCIONADOS");
  window.location.assign("http://192.168.20.9:8080/mainco/wps/exportar");
  </script>';
} else {
  $mysqli = sqlsrv_connect(Server(), connectionInfo());
  $sql_statement = "SELECT DISTINCT * FROM proyecto.promedio WHERE Descripcion = '" . $nombre . "'";
  $resultado = sqlsrv_query($mysqli, $sql_statement);

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
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'INFORME DE CONSOLIDADO');
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'OP');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('H5', '% PRODUC');
  while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, strval($row['fecha']));
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, strval($row['OP']));
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, strval($row['Descripcion']));
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, strval($row['tiempo_habil']));
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, strval($row['timepo_estimado']));
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, strval($row['tiempo_produccido']));
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, strval($row['eficiencia']));
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, strval($row['produccion']));


    $fila++;
  }

  $objPHPExcel->getActiveSheet()->setTitle('CONSOLIDADO');
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="CONSOLIDADO ' . $nombre . '.xlsx"');

  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');

  exit;
}
