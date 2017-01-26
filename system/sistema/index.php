<?php
    include("../includes/layout/head.php");
    include("../includes/layout/header.php");
    include("../includes/layout/sidebar.php");
    include("../includes/layout/cuerpo.php");
	$fecha = date('Y-m-j');
	$nuevafecha = strtotime ( '-6 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	$actualizado = paraTodos::arrayConsultanum("*", "datosper_act", "datac_cedula=$_SESSION[ci]");
	$consul = paraTodos::arrayConsulta("max(datac_fecha) as fecha", "datosper_act", "datac_cedula=$_SESSION[ci]");
	foreach($consul as $row){
		$ultact = $row[fecha];
	}
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
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h5><?php echo UsuariosModel::TotalPrestamo();?> Bs.<sup style="font-size: 20px"></sup></h5>
                        <p> Total Prestamos Otorgados </p>
                    </div>
                    <div class="icon"> <i class="ion ion-stats-bars"></i> </div> <a href="#" class="small-box-footer" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: 144,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							});">Ver<i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h5><?php echo UsuariosModel::Deudas();?> Bs.</h5>
                        <p><b><?php echo UsuariosModel::Cuotas();?></b> Cuotas Pendientes </p>
                    </div>
                    <div class="icon"> <i class="ion ion-pie-graph"></i> </div> <a href="#" class="small-box-footer" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: 144,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							});">Ver <i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
			<div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4>Datos Personales</h4>
                        <?php if ($ultact>$nuevafecha and $actualizado>0){?>
                        <h4>Actualizados ¡Gracias!</h4>
                        <?php } else {?>
						<h4 style="color:red">Actualizar</h4>
                        <?php } ?>
                    </div>
                    <div class="icon"> <i class="ion ion-person"></i> </div> <a href="#" class="small-box-footer" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: 150,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;">Actualizar <i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
    </section>
    <section>
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <h3 class="box-title">Datos Personales</h3> </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Codigo</label>
                            <p class="p-datosp"><?php echo $codigo;?></p>
                        </div>
                        <div class="col-md-2">
                            <label>Cédula</label>
                            <p class="p-datosp"><?php echo $cedula?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Nombres y Apellidos</label>
                            <p class="p-datosp"><?php echo $name;?></p>
                        </div>
						<div class="col-md-2">
                            <label>Fec. de Nacimiento</label>
                            <p class="p-datosp"><?php echo paraTodos::convertDate($fecnac);?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Télefono</label>
                            <p class="p-datosp"><?php echo $telefono;?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Correo</label>
                            <p class="p-datosp"><?php echo $correo;?></p>
                        </div>
                        <div class="col-md-12">
                            <label>Dirección</label>
                            <p class="p-datosp"><?php echo $direc;?></p>
                        </div>
						<div class="col-md-3">
                            <label>Fecha de Ingreso</label>
                            <p class="p-datosp"><?php echo paraTodos::convertDate($ingreso);?></p>
                        </div>
                        <div class="col-md-9">
                            <label>Ubicacion</label>
                            <p class="p-datosp"><?php echo $origen?> - <?php echo $condicion?></p>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" id="actualizar" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: 150,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;">Actualizar</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <section>
        <div class="col-md-12">
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <h3 class="box-title">Solicitudes de Prestamo Realizadas</h3> </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <table id="solicitudes" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>Nº</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
<?php
								$consulsol = paraTodos::arrayConsulta("sp.ID, tp.NAME, sp.FECHA, sp.MONTO, sp.ESTATUS", "solict_prest sp, tp_prest tp", " sp.TP_PREST=tp.ID and CEDULA=$_SESSION[ci] and sp.ESTATUS<>'ELIMINADO'");
								foreach($consulsol as $row){
							?>
                        <tr>							
								<td class="text-center"><?php echo $row[ID];?></td>
								<td class="text-center"><?php echo paraTodos::convertDate($row[FECHA]);?></td>
								<td class="text-center"><?php echo $row[NAME];?></td>								
								<td class="text-center"><?php echo number_format ( $row[MONTO],2, ',','.' );?></td>
								<td class="text-center"><?php echo $row[ESTATUS];?></td>
                        </tr>                        								
							<?php
								}
							?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
    <!-- /.content -->
    <?php
    include("../includes/layout/foot.php");

?>
        <script type="text/javascript">
            $(function () {
                $('#solicitudes').dataTable({
                    "language": {
                        "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
                    }
                });
            });
        </script>
