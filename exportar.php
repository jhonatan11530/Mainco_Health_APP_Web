<?php
require_once("ConexionSQL.php");
require_once 'PHPExcel.php';
error_reporting(0);

$Radio = $_POST["radiobutton"];
$fechainicial = $_POST['fechaUNO'];
$fechafinal = $_POST['fechaDOS'];


if($Radio==86 && isset($fechainicial) && isset($fechafinal)){

  $mysqli = sqlsrv_connect(Server() , connectionInfo());
  $sql_statement = "SELECT DISTINCT  fecha FROM proyecto.promedio WHERE fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."' AND eficiencia > 85 ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $sql_statement);

  while ($row = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){ 
    
    $fechas[]= $row['fecha'];
    
    }
    
        
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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL '.$fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL '.$fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% PRODUC');

  foreach ($fechas as $fecha) {
    
   
    

$consult = "SELECT  Descripcion FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
$result = sqlsrv_query($mysqli, $consult);
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
 $Descripcion = $row['Descripcion'];


}

$consult = "SELECT  tiempo_habil FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
$result = sqlsrv_query($mysqli, $consult);
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
   $tiempo_habil = $row['tiempo_habil'];

}

$consult = "SELECT  timepo_estimado FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
$result = sqlsrv_query($mysqli, $consult);
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
   $timepo_estimado = $row['timepo_estimado'];

}

$consult = "SELECT  tiempo_produccido FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
$result = sqlsrv_query($mysqli, $consult);
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
   $tiempo_produccido = $row['tiempo_produccido'];

  }

  $consult = "SELECT  eficiencia FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
     $eficiencia = $row['eficiencia'];
    
    }

    $consult = "SELECT produccion FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia > 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
     $produccion = $row['produccion'];
   
    }

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila ,$fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila ,$Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila ,$tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila ,$timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila ,$tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila ,$eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila ,$produccion);

   $fila++;
  }

  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');
  
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  
  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE '.$fechainicial.' AL '.$fechafinal.' EFICIENCIA MAYOR AL 85%.xlsx"');
  
  header('Cache-Control: max-age=0');
  
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  
  $objWriter->save('php://output');
  
  exit;
}

if($Radio==85 && isset($fechainicial) && isset($fechafinal)){
  
  $mysqli = sqlsrv_connect(Server() , connectionInfo());
  $sql_statement = "SELECT DISTINCT fecha FROM proyecto.promedio WHERE fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."' AND eficiencia < 85 ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $sql_statement);

  while ($row = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){ 
    
    $fechas[]= $row['fecha'];
    
    }
    
        
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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL '.$fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL '.$fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% PRODUC');

  foreach ($fechas as $fecha) {
    
  
  $consult = "SELECT Descripcion FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $Descripcion = $row['Descripcion'];


  }

  $consult = "SELECT tiempo_habil FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $tiempo_habil = $row['tiempo_habil'];

  }

  $consult = "SELECT DISTINCT  timepo_estimado FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $timepo_estimado = $row['timepo_estimado'];

  }

  $consult = "SELECT  tiempo_produccido FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $tiempo_produccido = $row['tiempo_produccido'];

  }

  $consult = "SELECT  eficiencia FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
    $eficiencia = $row['eficiencia'];
    
    }

    $consult = "SELECT  produccion FROM proyecto.promedio WHERE fecha='".$fecha."' AND eficiencia < 85";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
    $produccion = $row['produccion'];
  
    }

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila ,$fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila ,$Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila ,$tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila ,$timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila ,$tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila ,$eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila ,$produccion);

  $fila++;
  }

  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE '.$fechainicial.' AL '.$fechafinal.' EFICIENCIA MENOR AL 85%.xlsx"');

  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');

  exit;
}
if($Radio==200 && isset($fechainicial) && isset($fechafinal)){

 /* $mysqli = sqlsrv_connect(Server() , connectionInfo());
  $sql = "SELECT  Descripcion FROM proyecto.promedio WHERE fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."' ";
  $consulta = sqlsrv_query($mysqli, $sql);
  while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)){ 
    
    $names[]=$row['Descripcion'];
    }*/
  $mysqli = sqlsrv_connect(Server() , connectionInfo());
  $sql_statement = "SELECT DISTINCT fecha FROM proyecto.promedio WHERE fecha BETWEEN '".$fechainicial."' AND '".$fechafinal."' ORDER BY fecha ASC ";
  $resultado = sqlsrv_query($mysqli, $sql_statement);

  while ($row = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){ 
    
    $fechas[]=$row['fecha'];
    }

  $objPHPExcel = new PHPExcel();
  $fila =6;
  $filas =6;


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
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'FECHA INICIAL '.$fechainicial);
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'FECHA FINAL '.$fechafinal);
  $objPHPExcel->getActiveSheet()->setCellValue('A5', 'FECHA');
  $objPHPExcel->getActiveSheet()->setCellValue('B5', 'DESCRIPCION');
  $objPHPExcel->getActiveSheet()->setCellValue('C5', 'TIEMPO HABIL');
  $objPHPExcel->getActiveSheet()->setCellValue('D5', 'TIEMPO ESTIMADO');
  $objPHPExcel->getActiveSheet()->setCellValue('E5', 'TIEMPO PRODUCTIVO.');
  $objPHPExcel->getActiveSheet()->setCellValue('F5', '% EFIC');
  $objPHPExcel->getActiveSheet()->setCellValue('G5', '% PRODUC');
foreach ($fechas as $fecha) { 

  $consult = "SELECT  Descripcion FROM proyecto.promedio WHERE  fecha='".$fecha."'";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $Descripcion = $row['Descripcion'];
  }

  $consult = "SELECT  tiempo_habil FROM proyecto.promedio WHERE  fecha='".$fecha."'";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $tiempo_habil = $row['tiempo_habil'];
  }
//


$consult = "SELECT  timepo_estimado FROM proyecto.promedio WHERE fecha='".$fecha."'";
$result = sqlsrv_query($mysqli, $consult);
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
$timepo_estimado = $row['timepo_estimado'];
}

  $consult = "SELECT  tiempo_produccido FROM proyecto.promedio WHERE fecha='".$fecha."' ";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
  $tiempo_produccido = $row['tiempo_produccido'];

  }

  $consult = "SELECT  eficiencia FROM proyecto.promedio WHERE fecha='".$fecha."' ";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
    $eficiencia = $row['eficiencia'];
    
    }

    $consult = "SELECT   produccion FROM proyecto.promedio WHERE fecha='".$fecha."' ";
  $result = sqlsrv_query($mysqli, $consult);
  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){ 
    $produccion = $row['produccion'];



  
    }
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila ,$fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila ,$Descripcion);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila ,$tiempo_habil);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila ,$timepo_estimado);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila ,$tiempo_produccido);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila ,$eficiencia);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila ,$produccion);
    $fila++;
  }
 

  $objPHPExcel->getActiveSheet()->setTitle('INFORME GENERAL');

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="INFORME GENERAL DESDE'.$fechainicial.' AL '.$fechafinal.' EFICIENCIA GENERAL.xlsx"');

  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  $objWriter->save('php://output');/* */

  exit;

}
if(isset($fechainicial) && isset($fechafinal)){
  echo'<script type="text/javascript">
  alert("NO HAY REGISTRO DE LOS DATOS SELECCIONADOS");
  window.location.assign("http://192.168.20.9:8080/mainco/wps/exportar");
  </script>';
}
