<?php
    require_once('../includes/fpdf/fpdf.php');
    class PDF extends FPDF {
        function Header() {
            /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona superior del Documento ***/
         }
         function Footer() {
          /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona Inferior del Documento ***/
          }
     }
	$vicerrectorado = paraTodos::arrayConsulta("v.vic_descripcion,v.vic_codigo", "solict_prest sp, datos_per dp, vicerrectorado v, tp_prest tp", "sp.CEDULA=dp.datp_cedula and dp.datp_viccodigo=v.vic_codigo and sp.TP_PREST=tp.ID group by v.vic_descripcion order by v.vic_descripcion");
    $pdf=new PDF();
	$pdf->addpage();
	$pdf->SetFont('Arial','B',10);
	$pdf->Image($absolute_uri.'assets/img/logo.jpg',10,10,30);
	$pdf->Cell(0,5,utf8_decode('Fundación Fondo de Jubilaciones y Pensiones del Personal Académico'),0,1,'C');
	$pdf->Cell(0,5,utf8_decode('de la Universidad Nacional Experimental de los Llanos Occidentales'),0,1,'C');
	$pdf->Cell(0,5,utf8_decode('"Ezequiel Zamora"'),0,1,'C');
	$pdf->Cell(0,5,utf8_decode('"UNELLEZ"'),0,1,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,10,'SOLICITUDES REALIZADAS',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$cuenta=0;
	foreach ($vicerrectorado as $rowv){
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(190,5,$rowv['vic_descripcion'],1,1,'C');
        $consultotal = paraTodos::arrayConsulta("sum(sp.MONTO) as monto", "solict_prest sp, datos_per dp, vicerrectorado v, tp_prest tp", "sp.CEDULA=dp.datp_cedula and dp.datp_viccodigo=v.vic_codigo and sp.TP_PREST=tp.ID and v.vic_codigo=$rowv[vic_codigo]	order by dp.datp_viccodigo, sp.TP_PREST, sp.ESTATUS");
        foreach ($consultotal as $tot){
            $total = $tot[monto];
        }
		$solicitudes = paraTodos::arrayConsulta("dp.datp_cedula, dp.datp_apellidos, dp.datp_nombres, sp.MONTO, tp.NAME, v.vic_descripcion, sp.FECHA, sp.ESTATUS", "solict_prest sp, datos_per dp, vicerrectorado v, tp_prest tp", "sp.CEDULA=dp.datp_cedula and dp.datp_viccodigo=v.vic_codigo and sp.TP_PREST=tp.ID and v.vic_codigo=$rowv[vic_codigo]	order by dp.datp_viccodigo, sp.TP_PREST, sp.ESTATUS");
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,4,utf8_decode('Nº'),1,0,'C');
		$pdf->Cell(20,4,'Fecha',1,0,'C');
		$pdf->Cell(20,4,utf8_decode('Cédula'),1,0,'C');
		$pdf->Cell(45,4,'Nombre',1,0,'C');
		$pdf->Cell(45,4,'Apellido',1,0,'C');
		$pdf->Cell(25,4,'Monto',1,0,'C');
		$pdf->Cell(25,4,'Estatus',1,0,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();
		$cuenta= 0;
		foreach($solicitudes as $rowf){
			$cuenta= $cuenta+1;
			$pdf->Cell(10,5,$cuenta,1,0,'C');
			$pdf->Cell(20,5,paraTodos::convertDate($rowf['FECHA']),1,0,'L');
			$pdf->Cell(20,5,$rowf['datp_cedula'],1,0,'L');
			$pdf->Cell(45,5,utf8_decode($rowf['datp_nombres']),1,0,'L');
			$pdf->Cell(45,5,utf8_decode($rowf['datp_apellidos']),1,0,'L');
			$pdf->Cell(25,5,number_format($rowf['MONTO'],2,',','.')." Bs.",1,0,'L');
			$pdf->Cell(25,5,$rowf['ESTATUS'],1,0,'L');
			$pdf->Ln();
		}
        $pdf->Cell(140,5,'Total.:',0,0,'R');
        $pdf->Cell(25,5,number_format($total,2,',','.')." Bs.",1,0,'L');
        $pdf->Ln();
	}
    $pdf->Output();
?>
