
<?php
	include_once("modelo/estadocuenta/class.estadoc.php");
	$datos = paraTodos::arrayConsulta("*", "asoc", " CEDULA=$_SESSION[ci]");
	foreach ($datos as $row){
		$nombre = $row[NAME];
		$codigo = $row[CODIGO];
		$ingreso = $row[INGRESO];
		$ubicacion = $row[ORIGEN];
	}
?>
<section class="content invoice">
    <!-- title row -->
    <div class="row">
    <a href="accion.php" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->FONJUPROF </a>       
        <!-- /.col -->
    </div>
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col"> <b>Asociado:</b> <?php echo $_SESSION[ci];?> - <?php echo $nombre;?>
            <br> <b>Ubicación:</b> <?php echo $ubicacion;?></div>
        <div class="col-sm-4 invoice-col" align="center">
            <br> <b>Código:</b> <?php echo $codigo; ?></div>
        <div class="col-sm-4 invoice-col">
            <br> <b>Fecha de Ingreso:</b> <?php echo $ingreso; ?></div>
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