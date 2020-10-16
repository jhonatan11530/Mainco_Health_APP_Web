<?php
require_once("ConexionSQL.php");
require_once 'PHPExcel.php';
 $fechainicial = $_REQUEST['HUMANA'];


$mysqli = sqlsrv_connect(Server() , connectionInfo());
$sql_statement = "SELECT * FROM proyecto.gestion WHERE fecha='".$fechainicial."'";
$resultado = sqlsrv_query($mysqli, $sql_statement);

$objPHPExcel = new PHPExcel();
$fila =6;
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
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'INFORME DE ERRORES DE LA APP');
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'CODIGO OPERARIO');
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'NUMERO DE O.P');
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'NOMBRE DEL DISPOSITIVO');
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'DIRRECION IP');
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'HORA');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'FECHA');
while ($row = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){ 
  $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila ,strval($row['nombre'] ));
  $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila ,strval($row['inicial'] ));
  $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila ,strval($row['final'] ));
  $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila ,strval($row['motivo']) );
  $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila ,strval($row['tiempo']) );
  $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila ,strval($row['fecha'] ));
    $fila++;
  }
$objPHPExcel->getActiveSheet()->setTitle('INFORME DE ERRORES');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="INFORME DE ERRORES.xlsx"');

header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');

exit;
