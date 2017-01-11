<?php
    $ci=$_SESSION[ci];
    $tipo=$_GET['tipo'];
    $agno=date("Y");
    $mes=date("n")-1;
    if ($mes==0){ $mes=1; $agno=$agno-1; }
    $fecha=$agno."-".$mes; 
    require_once('../includes/fpdf/fpdf.php');
    class PDF extends FPDF {
        function Header() {
            /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona superior del Documento ***/
         }
         function Footer() {
          /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona Inferior del Documento ***/
          }
     }
    $pdf=new PDF(); 
    $Conexion_SQL = pg_connect("host=$Host user=$UserDB password=$PasswDB dbname=$DataBase")  or die('ERROR el Conectarse con el Servidor o la Base de Datos'.pg_errormessage());
    $Consulta_Schema = pg_query("SET search_path TO 'SIMA001'") or die('ERROR al Selecionar el Esquema de la Base de Datos'.pg_errormessage());; /*ESQUEMA ACTIVO DE LOS DATOS*/
    $consulta="SELECT DISTINCT (codnom) as codnom,codemp, fecnom  FROM nphiscon WHERE codemp='$ci' AND fecnom='$FechaNomina'";
    $Consulta_cabecera=pg_query($consulta) or die('El Nro de CI indicado no se encuentra en DB. Verificando DC NPHISCON'.pg_errormessage());
    while($Array_cabecera = pg_fetch_array($Consulta_cabecera)) {
        $codnom=$Array_cabecera['codnom'];
        $pdf->AddPage();
        /*NPHOJINT*/    
        $SQL_DatPer="SELECT codemp, cedemp, nomemp, fecing, fecret  FROM nphojint WHERE codemp='$ci'";
        $Consulta_DatPer=pg_query($SQL_DatPer) or die("El Nro de CI indicado no se encuentra en DB. Verificando NPHOJINT ".pg_errormessage());    
        $Array_DatPer = pg_fetch_array($Consulta_DatPer);
        $NomEmp=$Array_DatPer['nomemp'];
        $CedEmp=$Array_DatPer['cedemp'];
        $Fecha=$Array_DatPer['fecing'];
        $FechaR=$Array_DatPer['fecret'];
        $diaf = substr($Fecha, 8, 2);
        $mesf   = substr($Fecha, 5, 2);
        $anof = substr($Fecha,0, 4);
        $FecIng = $diaf . '/' . $mesf . '/' . $anof;        
        $diar = substr($FechaR, 8, 2);
        $mesr   = substr($FechaR, 5, 2);
        $anor = substr($FechaR,0, 4);
        if($diar){ $FecRet = $diar . '/' . $mesr . '/' . $anor; }        
        $sqlcargo="SELECT DISTINCT (codcar) as codcar FROM nphiscon WHERE codemp='$ci' AND fecnom='$FechaNomina' and codnom='$codnom'";
        $Querycargo=pg_query($sqlcargo)or die("El Nro de CI indicado no se encuentra en DB. Verificando Cambio de Cargo en NPHISCON  ".pg_errormessage());
        $nominacargo=pg_fetch_array($Querycargo);
        $CodCar=$nominacargo['codcar'];
        /*NPASICAREMP*/
        $SQL_Cargo="SELECT codemp, codcar, nomcar, codnom, nomnom, status  FROM npasicaremp WHERE codemp='$ci' AND codnom='$codnom' AND codcar='$CodCar' AND status='V'";
        $Consulta_Cargo=pg_query($SQL_Cargo) or die("El Nro de CI indicado no se encuentra en DB. Verificando NPASICAREMP ".pg_errormessage());
        $Array_Cargo = pg_fetch_array($Consulta_Cargo);
        $CodCar=$Array_Cargo['codcar'];
        $NomCar=$Array_Cargo['nomcar'];
        $CodNom=$Array_Cargo['codnom'];
        $NomNom=$Array_Cargo['nomnom'];
        $SQL_ConceptosNormal="SELECT nphiscon.codemp, nphiscon.codnom, nphiscon.codcon, nphiscon.nomcon, nphiscon.monto, nphiscon.especial, nphiscon.fecnom, npdefcpt.opecon, nphiscon.codcar, nphiscon.codnomesp";
        $SQL_ConceptosNormal=$SQL_ConceptosNormal." FROM nphiscon, npdefcpt";
        $SQL_ConceptosNormal=$SQL_ConceptosNormal." WHERE  nphiscon.codcon = npdefcpt.codcon AND nphiscon.codnom='$codnom' AND nphiscon.codemp='$ci' AND nphiscon.fecnom='$FechaNomina' ORDER BY nphiscon.codcon ASC";
        $Consulta_ConceptosNormal=pg_query($SQL_ConceptosNormal) or die("El Nro de CI indicado no se encuentra en DB. Verificando Conceptos pagados en NPHISCON ".pg_errormessage());
        while($Array_ConceptosNormal = pg_fetch_array($Consulta_ConceptosNormal)) {
            $CodCon=(int)$Array_ConceptosNormal['codcon'];
            $NomCon=substr($Array_ConceptosNormal['nomcon'], 0, 100); 
            $Monto=$Array_ConceptosNormal['monto'];
            $TipCon=$Array_ConceptosNormal['opecon'];
            $TipNom=$Array_ConceptosNormal['especial'];
            $CodNomEsp=$Array_ConceptosNormal['codnomesp'];          
            if (($TipCon=='A') AND ($TipNom=='N')){  $TotalAsiganciones= $TotalAsiganciones+$Monto; }           
            if (($TipCon=='A') AND ($TipNom=='S') AND ($CodNomEsp=='001')){  $TotalAsigancionesEsp= $TotalAsigancionesEsp+$Monto; } 
            if (($TipCon=='D')AND ($TipNom=='N') AND ($CodNomEsp=='001') AND ($CodCon!=900)){ $TotalDeducciones= $TotalDeducciones+$Monto; }
            if (($TipCon=='D')AND ($TipNom=='S') AND ($CodNomEsp=='001') AND ($CodCon!=900)){ $TotalDeduccionesEsp= $TotalDeduccionesEsp+$Monto; }
            if ($CodCon=='202'){$CajaAhorro=$CajaAhorro+$Monto;} if ($CodCon=='702'){$CajaAhorro=$CajaAhorro+$Monto;}
            if ($CodCon=='501'){$CajaAhorro=$CajaAhorro+$Monto;} if ($CodCon=='701'){$CajaAhorro=$CajaAhorro+$Monto;}
            if ($CodCon=='250'){$CajaAhorro=$CajaAhorro+$Monto;} if ($CodCon=='757'){$CajaAhorro=$CajaAhorro+$Monto;}
            if ($CodCon=='001'){$SueldoBase=$SueldoBase+$Monto;}
        }        
        $SueldoMensual=(($TotalAsiganciones+$TotalAsigancionesEsp)-($TotalDeducciones+$TotalDeduccionesEsp));
        $FraccionBono=((($TotalAsiganciones+$TotalAsigancionesEsp+$CajaAhorro)/30)*90)/12;
        $FraccionBonoVac=((($TotalAsiganciones+$TotalAsigancionesEsp+$CajaAhorro)/30)*90)/12;
        $FraccionBonoNav=((($TotalAsiganciones+$TotalAsigancionesEsp+$CajaAhorro)/30)*90)/12;
        $SueldoIntegralMensual=($TotalAsiganciones+$TotalAsigancionesEsp+$FraccionBonoVac+$FraccionBonoNav);
        switch ($tipo) {
            case 1 :
                $sueld=number_format($SueldoBase,2,',','.');
                $cont="devengando un sueldo base mensual de bolívares: $sueld";
                $Tips="Base";
                break;
            case 2 :
                $sueld=number_format($SueldoMensual,2,',','.');
                $cont="devengando un sueldo mensual de bolívares:$sueld";
                $Tips="Neto Mensual";
                break;
            case 3 :
                $sueld=number_format($SueldoIntegralMensual,2,',','.');
                $cont="devengando un sueldo integral mensual de bolívares: $sueld";
                $Tips="Integral Mensual";
                break;
            case 4 :
                $sueldo_anual=$SueldoIntegralMensual*12;
                $sueld=number_format($sueldo_anual,2,',','.');
                $cont="devengando un sueldo integral anual de bolívares: $sueld";
                $Tips="Integral Anual";
                break;
            case 5 :
                $cont=" ";
                break;
        }
        if ($CodNom=='002' || $CodNom=='003' || $CodNom=='011' || $CodNom=='012' || $CodNom=='024' || $CodNom=='026')   { $labo='laboró en'; $hasta='hasta el : ';  $desempeñandose='desempeñandose'; }
        else if ($CodNom=='004' || $CodNom=='013' || $CodNom=='025') { $labo='recibe de'; $desempeñandose='la pensión'; }
        else { $labo='labora en'; $desempenandose='desempeñandose  actualmente '; }
        if ($CodNom=='008') { $NomNom ='ADMINISTRATIVO CONTRATADO'; } if ($CodNom=='009') { $NomNom ='OBRERO CONTRATADO'; }
        $base="Quien suscribe Jefe de los Recursos Humanos de la Universidad Nacional Experimental de los Llanos  Occidentales \"Ezequiel Zamora\" UNELLEZ, por medio de la presente hace constar que el ciudadano (a): $NomEmp  titular de la Cédula de Identidad Nº: $CedEmp $labo  esta Casa  de Estudio desde el: $FecIng  $hasta $FecRet $desempenandose en el cargo de: $NomCar en su condición actual de personal: $NomNom ";
        $pdf->SetFont('Times','U',20);
        $pdf->SetLeftMargin(30);
        $pdf->SetRightMargin(30);
        $pdf->SetY(40);
        $pdf->Cell(0,10,'CONSTANCIA',0,55,'C');
        $pdf->Cell(0,10,'',0,60,'C');
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,10,utf8_decode($base.$cont),'J');
        $pdf->ln();
        setlocale(LC_TIME, "es_VE.utf8"); 
        $fechac=strftime("%A %d de %B de %Y a las %T");
        $pdf->SetFont('Arial','',10);
        //$pdf->MultiCell(0,5,utf8_decode("Puede corroborar la veracidad de éste documento a través de la página web    http://www.unellez.edu.ve/unellez/servicios/constancia/verifica.php usando el código de validación $clave_md5"),0,'C');
        $pdf->MultiCell(0,5,utf8_decode("Impresión realizada el día ".$fechac),0,'C');
        $TotalAsiganciones=0; $TotalAsigancionesEsp=0; $TotalDeducciones=0;  $TotalDeduccionesEsp=0; $CajaAhorro=0;
    }/*FIN DOBLE CONDICON EN LA NPHISCON*/
    $pdf->Output();
?>