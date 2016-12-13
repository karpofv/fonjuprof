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
<<<<<<< HEAD
	if (!move_uploaded_file($tmp_archivo, $archivador)) {
		$return = $nuevo_nombre."Ocurrio un error al subir el archivo. ".$nombre_archivo." No pudo guardarse.";
	} else {
		$handle = @fopen($upload_folder.'/'.$nombre_archivo,"r+");
		//$handle = @fopen('../archivos/AMORT_ESP.csv',"r+");
=======
	/*if (!move_uploaded_file($tmp_archivo, $archivador)) {
		$return = $nuevo_nombre."Ocurrio un error al subir el archivo. ".$nombre_archivo." No pudo guardarse.";
	} else {*/
		//$handle = @fopen($upload_folder.'/'.$nombre_archivo,"r+");
		$handle = @fopen('../archivos/AMORT_ESP.csv',"r+");
>>>>>>> master
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
				$buffer[9] = trim(str_replace("'","",$buffer[8]));
				$buffer[10] = trim(str_replace("'","",$buffer[10]));
				//$buffer[1]."<br>...";				
				if ($count>0) {
					//Se consulta si el asociado existe en la respectiva tabla
					$cons_asoc = paraTodos::arrayConsultanum("PREST", "amort_esp", "PREST='$buffer[0]' and ID='$buffer[1]'");
					if ($cons_asoc == 0) {
						$insertar .= "INSERT INTO amort_esp(PREST, ID, MONTO, TASA, VENC, PAGADA_EL, CANC, INTE, ABONO, PAGO, RESTA) VALUES ('$buffer[0]','$buffer[1]','$buffer[2]','$buffer[3]','$buffer[4]','$buffer[5]','$buffer[6]','$buffer[7]','$buffer[8]','$buffer[9]','$buffer[10]');";
<<<<<<< HEAD
						set_time_limit(1);
					} else {
						$update .= "UPDATE amort_esp SET MONTO='$buffer[2]',TASA='$buffer[3]',VENC='$buffer[4]',PAGADA_EL='$buffer[5]',CANC='$buffer[6]',INTE='$buffer[7]',ABONO='$buffer[8]',PAGO='$buffer[9]',RESTA='$buffer[10]' WHERE PREST='$buffer[0]' and ID='$buffer[1]';";
=======
						set_time_limit(1);						
					} else {
						$update .= "UPDATE amort_esp SET MONTO='$buffer[2]',TASA='$buffer[3]',VENC='$buffer[4]',PAGADA_EL='$buffer[5]',CANC='$buffer[6]',INT='$buffer[7]',ABONO='$buffer[8]',PAGO='$buffer[9]',RESTA='$buffer[10]' WHERE PREST='$buffer[0]' and ID='$buffer[1]';";
>>>>>>> master
					}
				}
				$count=$count+1;
			}
			$ejecutar = paraTodos::arrayejecutar($update);
			$result = paraTodos::arrayejecutar($insertar);
			fclose($handle);			
		}		
<<<<<<< HEAD
	}
=======
	/*}*/
>>>>>>> master
?>