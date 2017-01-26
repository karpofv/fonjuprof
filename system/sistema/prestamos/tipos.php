<?php
	$codigo = $_POST[codigo];
	$nombre = $_POST[nombre];
	$interes = $_POST[interes];
	$cuotas = $_POST[cuotas];
	$montomax = $_POST[montomax];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*paraTodos::showMsg("$codigo", "alert-success");*/
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("*", "tp_prest tp", "tp.NAME='$nombre'");
		if ($consul>0){
			paraTodos::showMsg("Ya existe un tipo de prestamo bajo este nombre", "alert-danger");
		} else{
			paraTodos::arrayInserte("NAME, INTERES, CUONTAS, MTO_MAX", "tp_prest", "'$nombre', '$interes', $cuotas, $montomax");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $nombre ==""){
		$consulta = paraTodos::arrayConsulta("*", "tp_prest tp", "tp.ID=$codigo");
		foreach($consulta as $row){
			$nombre = $row[NAME];
			$interes = $row[INTERES];
			$cuotas = $row[CUONTAS];
			$montomax = $row[MTO_MAX];
		}
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		paraTodos::arrayUpdate("NAME='$nombre', INTERES='$interes', CUONTAS=$cuotas, MTO_MAX=$montomax", "tp_prest", "ID=$codigo");
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		$consul = paraTodos::arrayConsultanum("*", "prest p", " p.TP_PREST=$codigo");
		if($consul >0){
			paraTodos::showMsg("No se puede eliminar existen asociados con este tipo de prestamo asignado", "alert-danger");
		} else {
			paraTodos::arrayDelete("ID=$codigo", "tp_prest");
		}
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Tipo de Prestamos</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal">
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="nombre">Descripción</label>
						<div class="col-sm-8">
							<input class="form-control" id="nombre" type="text" value="<?php echo $nombre; ?>">
							<input class="form-control collapse" id="codigo" type="text" value="<?php echo $codigo; ?>">
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="interes">Interes</label>
						<div class="col-sm-8">
							<input class="form-control" id="interes" type="text" value="<?php echo $interes;?>">
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="cuotas">Cuotas</label>
						<div class="col-sm-8">
							<input class="form-control" id="cuotas" min="1" type="number" value="<?php echo $cuotas;?>">
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="montomax">Monto Maximo</label>
						<div class="col-sm-8">
							<input class="form-control" id="montomax" min="1" type="number" value="<?php echo $montomax;?>">
						</div>
					</div>
                    <div class="box-footer">
                        <input id="enviar" type="button" value="Guardar" class="btn btn-primary col-md-offset-5" onclick="
<?php
						if($editar==""){
?>
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									nombre 	: $('#nombre').val(),
									interes: $('#interes').val(),
									cuotas: $('#cuotas').val(),
									montomax: $('#montomax').val(),
									insertar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
										$('#codigo').val('');
										$('#nombre').val('');
										$('#interes').val('');
										$('#cuotas').val('');
										$('#montomax').val('');
								},
							}); return false;
<?php
						} else {
?>
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: $('#codigo').val(),
									nombre 	: $('#nombre').val(),
									interes: $('#interes').val(),
									cuotas: $('#cuotas').val(),
									montomax: $('#montomax').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#codigo').val('');
									$('#nombre').val('');
									$('#interes').val('');
									$('#cuotas').val('');
									$('#montomax').val('');
								},
							}); return false;
<?php
					}
?>
                   ">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Usuarios Registrados</h3> </div>
            <div class="col-xs-12 box-body table-responsive no-padding">
                <table class="table table-hover" id="tp_prest">
                    <thead>
                        <tr>
                            <td ><strong>Prestamo</strong></td>
                            <td class="text-center"><strong>Interes</strong></td>
                            <td class="text-center"><strong>Cuotas</strong></td>
                            <td class="text-center"><strong>Monto maximo</strong></td>
                            <td class="text-center"><strong>Editar</strong></td>
                            <td class="text-center"><strong>Eliminar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
								$consulsol = paraTodos::arrayConsulta("*", "tp_prest", "1=1");
								foreach($consulsol as $row){
							?>
                        <tr>
								<td ><?php echo $row[NAME];?></td>
								<td class="text-center"><?php echo $row[INTERES];?>%</td>
								<td class="text-center"><?php echo $row[CUONTAS];?></td>
								<td class="text-center"><?php echo number_format ( $row[MTO_MAX],2, ',','.' );?></td>
								<td class="text-center">
									<a href="javascript:void(0);" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: <?php echo $row[ID];?>,
									editar 	: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;"><i class="fa fa-edit"></i>
									</a>
								</td>
								<td class="text-center">
									<a href="javascript:void(0);" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: <?php echo $row[ID];?>,
									eliminar : 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;"><i class="fa fa-eraser"></i>
									</a>
								</td>
                        </tr>
							<?php
								}
							?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.row -->
</section>
<script>
		$('#tp_prest').DataTable({
			"language": {
				"url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
        	}
		});
</script>
