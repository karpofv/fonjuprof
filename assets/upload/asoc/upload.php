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
		//$handle = @fopen('archivos/ASOC.csv',"r+");
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
				$cedula = preg_replace("/\s+/", "", $buffer[1]);
				$cedula = preg_replace("/ +/", "", $cedula);
				$cedula = str_replace(" ","",$cedula);
				$cedula = ltrim(trim(str_replace("'","",$cedula)));
				//$buffer[1]."<br>...";
				if (!$cedula=="" and $count>0) {
					//Se consulta si el asociado existe en la respectiva tabla
					$cons_asoc = paraTodos::arrayConsultanum("CEDULA", "asoc", "CEDULA='$cedula'");
					if ($cons_asoc == 0) {
						$insertar .= "INSERT INTO asoc (ORIGEN, CEDULA, NAME, TELEFONO, CODIGO, INGRESO, DEUDA, FIANZAS, CORREO) VALUES('$buffer[0]','$buffer[1]','$buffer[2]','$buffer[3]','$buffer[4]','$buffer[5]','$buffer[6]','$buffer[7]','$buffer[8]');";
						set_time_limit(1);
					} else {
						$update .= "UPDATE asoc SET  ORIGEN='$buffer[0]', NAME='$buffer[2]', TELEFONO='$buffer[3]', CODIGO='$buffer[4]', CORREO='$buffer[9]', INGRESO='$buffer[5]', DEUDA='$buffer[6]', FIANZAS='$buffer[7]' WHERE CEDULA='$buffer[1]';";
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
