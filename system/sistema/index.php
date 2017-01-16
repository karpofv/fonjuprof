<?php
    include("../includes/layout/head.php");
    include("../includes/layout/header.php");
    include("../includes/layout/sidebar.php");
    include("../includes/layout/cuerpo.php");
	$consul = paraTodos::arrayConsulta("*", "", "");
?>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h5>53.000,00 Bs.F<sup style="font-size: 20px"></sup></h5>
                        <p> Deudas </p>
                    </div>
                    <div class="icon"> <i class="ion ion-stats-bars"></i> </div> <a href="#" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h5>65.000,00 Bs.F</h5>
                        <p> Cuotas Pendientes </p>
                    </div>
                    <div class="icon"> <i class="ion ion-pie-graph"></i> </div> <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a> </div>
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
                            <p><?php echo $datosPersonales[CODIGO];?></p>
                        </div>
                        <div class="col-md-2">
                            <label>Cédula</label>
                            <p><?php echo $datosPersonales[CEDULA]?></p>
                        </div>
                        <div class="col-md-8">
                            <label>Nombres y Apellidos</label>
                            <p><?php echo $datosPersonales[NAME];?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Télefono</label>
                            <p><?php echo $datosPersonales[TELEFONO];?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Correo</label>
                            <p>0412-4289536</p>
                        </div>
                        <div class="col-md-12">
                            <label>Fecha de Ingreso</label>
                            <p><?php echo $datosPersonales[INGRESO];?></p>
                        </div>
                        <div class="col-md-9">
                            <label>Ubicacion</label>
                            <p><?php echo $datosPersonales[ORIGEN]?></p>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" id="actualizar">Actualizar</button>
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
                    <h3 class="box-title">Solicitudes Realizadas</h3> </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <table id="solicitudes" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>Nº</th>
                                    <th>fecha</th>
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
								<td class="text-center"><?php echo $row[FECHA];?></td>
								<td class="text-center"><?php echo $row[NAME];?></td>								
								<td class="text-center"><?php echo $row[MONTO];?></td>
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
