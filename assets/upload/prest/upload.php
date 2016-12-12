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
				$buffer[9] = trim(str_replace("'","",$buffer[8]));
				$buffer[10] = trim(str_replace("'","",$buffer[10]));
				$buffer[11] = trim(str_replace("'","",$buffer[11]));
				$buffer[12] = trim(str_replace("'","",$buffer[12]));
				$buffer[13] = trim(str_replace("'","",$buffer[13]));
				$buffer[14] = trim(str_replace("'","",$buffer[14]));
				$buffer[15] = trim(str_replace("'","",$buffer[15]));
				$buffer[16] = trim(str_replace("'","",$buffer[16]));
				$buffer[17] = trim(str_replace("'","",$buffer[17]));
				$buffer[18] = trim(str_replace("'","",$buffer[18]));
				$buffer[19] = trim(str_replace("'","",$buffer[19]));
				$buffer[20] = trim(str_replace("'","",$buffer[20]));
				$buffer[21] = trim(str_replace("'","",$buffer[21]));
				$cedula = preg_replace("/\s+/", "", $buffer[2]);
				$cedula = preg_replace("/ +/", "", $cedula);
				$cedula = str_replace(" ","",$cedula);
				$cedula = ltrim(trim(str_replace("'","",$cedula)));
				//$buffer[1]."<br>...";				
				if (!$cedula=="" and $count>0) {
					//Se consulta si el asociado existe en la respectiva tabla
					$cons_asoc = paraTodos::arrayConsultanum("CEDULA", "asoc", "CEDULA='$cedula'");
					if ($cons_asoc == 0) {
						$insertar .= "INSERT INTO asoc (INSTT, ORIGEN, CEDULA, NAME, TELEFONO, CODIGO, CORREO, INGRESO, APT_PERS_CANC, APT_PERS_PDT, APT_PAT_CANC, APT_PAT_PDT, APT_VOL, AHORRADO, DEUDA, FIANZAS, CUOTAS_VENC, DISP, ULT_RET_80, ULT_RET_50, ULT_RET_25, ULT_RET_20) VALUES('$buffer[0]','$buffer[1]','$buffer[2]','$buffer[3]','$buffer[4]','$buffer[5]','$buffer[6]','$buffer[7]','$buffer[8]','$buffer[9]','$buffer[10]','$buffer[11]','$buffer[12]','$buffer[13]','$buffer[14]','$buffer[15]','$buffer[16]','$buffer[17]','$buffer[18]','$buffer[19]','$buffer[20]','$buffer[21]');";					
					} else {
						$update .= "UPDATE asoc SET  INSTT='$buffer[0]', ORIGEN='$buffer[1]', NAME='$buffer[3]', TELEFONO='$buffer[4]', CODIGO='$buffer[5]', CORREO='$buffer[6]', INGRESO='$buffer[7]', APT_PERS_CANC='$buffer[8]', APT_PERS_PDT='$buffer[9]', APT_PAT_CANC='$buffer[10]', APT_PAT_PDT='$buffer[11]', APT_VOL='$buffer[12]', AHORRADO='$buffer[13]', DEUDA='$buffer[14]', FIANZAS='$buffer[15]', CUOTAS_VENC='$buffer[16]', DISP='$buffer[17]', ULT_RET_80='$buffer[18]', ULT_RET_50='$buffer[19]', ULT_RET_25='$buffer[20]', ULT_RET_20='$buffer[21]' WHERE CEDULA='$buffer[2]';";
					}
				}
				$count=$count+1;
			}
			$ejecutar = paraTodos::arrayejecutar($update);
			$result = paraTodos::arrayejecutar($insertar);
			print_r($update);
			fclose($handle);			
		}		
	}
?>