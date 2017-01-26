
<?php
	include_once("modelo/estadocuenta/class.estadoc.php");
	$consuldper = paraTodos::arrayConsultanum("*", "datos_per", "datp_cedula=$_SESSION[ci]");
	if ($consuldper>0){
		$consul = paraTodos::arrayConsulta("*", "datos_per dp, vicerrectorado v, condicion c", " dp.datp_viccodigo=v.vic_codigo and dp.datp_condcodigo=c.cond_codigo and datp_cedula=$_SESSION[ci]");
		foreach($consul as $row){
			$codigo = $datosPersonales[CODIGO];
			$cedula = $row[datp_cedula];
			$name = $row[datp_nombres]." ".$row[datp_apellidos];
			$telefono = $row[datp_telefono];
			$correo = $row[datp_correo];
			$ingreso = $row[datp_fecing];
			$fecnac = $row[datp_fecnac];
			$origen = $row[vic_descripcion];
			$condicion = $row[cond_descripcion];
			$direc = $row[datp_direccion];
		}
	} else {
			$codigo = $datosPersonales[CODIGO];
			$cedula = $datosPersonales[CEDULA];
			$name = $datosPersonales[NAME];
			$telefono = $datosPersonales[TELEFONO];
			$correo = $datosPersonales[CORREO];
			$ingreso = $datosPersonales[INGRESO];
			$origen = $datosPersonales[ORIGEN];
			$fecnac = 'No actualizada';
			$direc = 'No actualizada';
	}
?>
<section class="content invoice">
    <!-- title row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col"> <b>Asociado:</b> <?php echo $cedula;?> - <?php echo $name;?>
            <br> <b>Ubicación:</b> <?php echo $origen;?> - <?php echo $condicion;?></div>
        <div class="col-sm-4 invoice-col" align="center">
            <br> <b>Código:</b> <?php echo $codigo; ?> </div>
        <div class="col-sm-4 invoice-col">
            <br> <b>Fecha de Ingreso:</b> <?php echo paraTodos::convertDate($ingreso); ?></div>
    </div>    
    <hr>
    <div class="" id="estado_content">
        <div class="col-xs-12 box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" align="center"><strong>Cancelado</strong></td>
                        <td colspan="2" align="center"><strong>Pendiente</strong></td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <td align="right"><strong>Prestamo</strong></td>
                        <td><strong>Tipo de Prestamo</strong></td>
                        <td align="right"><strong>Fecha</strong></td>
                        <td align="right"><strong>Monto</strong></td>
                        <td align="right"><strong>Normal</strong></td>
                        <td align="right"><strong>Especial</strong></td>
                        <td align="right"><strong>Normal</strong></td>
                        <td align="right"><strong>Especial</strong></td>
                    </tr>
                </thead>
                <tbody>
                   <?php
						estadocuenta::resumen($_SESSION[ci]);
					?>
                </tbody>
                <tbody>
                    <tr>
                   <?php
						estadocuenta::resumentotal($_SESSION[ci]);
					?>                        
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="window.print()"><i class="fa fa-print"></i> Imprimir</button>
        </div>
    </div>
</section>
