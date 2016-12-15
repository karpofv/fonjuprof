<?php
	//session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
	include_once("../../../includes/conf/auth.php");
	include_once("../../../includes/tools.php");
    include_once ('../../../includes/conexion.php');
	$return = Array('ok'=>TRUE);
	$upload_folder ='../archivos';
	$nombre_archivo = $_FILES['archivo']['name'];
	$tipo_archivo = $_FILES['archivo']['type'];
	$tamano_archivo = $_FILES['archivo']['size'];
	$tmp_archivo = $_FILES['archivo']['tmp_name'];
	$archivador = $upload_folder . '/' . $nombre_archivo;
    if (!move_uploaded_file($tmp_archivo, $archivador)) {
		$return = $nuevo_nombre."Ocurrio un error al subir el archivo. ".$nombre_archivo." No pudo guardarse.";
	} else {
		$handle = @fopen($upload_folder.'/'.$nombre_archivo,"r+");
		//$handle = @fopen('../archivos/PREST.csv',"r+");
        if ($handle) {
			$count==0;
			$insertar ="";
			$update = "";
			while (!feof($handle)) {
				$buffer = fgets($handle);
				$buffer = split(';',$buffer);
				//fwrite($handle,"\n");
				$buffer[0] = trim(str_replace("'","",$buffer[0]));
				$buffer[1] = trim(str_replace("'","",$buffer[1]));
				$buffer[2] = trim(str_replace("'","",$buffer[2]));
				$buffer[3] = trim(str_replace("'","",$buffer[3]));
				$buffer[4] = trim(str_replace("'","",$buffer[4]));
				$buffer[5] = trim(str_replace("'","",$buffer[5]));
				$buffer[6] = trim(str_replace("'","",$buffer[6]));
				$buffer[7] = trim(str_replace("'","",$buffer[7]));
				$buffer[8] = trim(str_replace("'","",$buffer[8]));
				$buffer[9] = trim(str_replace("'","",$buffer[9]));
				//$buffer[1]."<br>...";
				if ($count>0) {
					//Se consulta si el asociado existe en la respectiva tabla
					$cons_asoc = paraTodos::arrayConsultanum("ID", "tp_prest", "ID='$buffer[0]'");
					if ($cons_asoc == 0) {
						$insertar .= "INSERT INTO tp_prest(ID, NAME, INTERES, CUONTAS, MTO_MAX, METODO_MORT, SERVICIOS, REPETIDO, GASTOS, CTAS_ESP) VALUES('$buffer[0]','$buffer[1]','$buffer[2]','$buffer[3]','$buffer[4]','$buffer[5]','$buffer[6]','$buffer[7]','$buffer[8]','$buffer[9]');";
						set_time_limit(1);
					} else {
						$update .= "UPDATE tp_prest SET NAME='$buffer[1]', INTERES='$buffer[2]',CUONTAS='$buffer[3]', MTO_MAX='$buffer[4]', METODO_MORT='$buffer[5]', SERVICIOS='$buffer[6]', REPETIDO='$buffer[7]', GASTOS='$buffer[8]', CTAS_ESP='$buffer[9]' where ID='$buffer[0]';";
						set_time_limit(1);
					}
				}
				$count=$count+1;
			}
			$ejecutar = paraTodos::arrayejecutar($update);
			$result = paraTodos::arrayejecutar($insertar);
			fclose($handle);
		}
	}
?>
