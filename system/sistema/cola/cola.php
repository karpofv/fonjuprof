<?php
	$codigo = $_POST[codigo];
	$vicec = $_POST[vicec];
	$tpprest = $_POST[tpprest];
	$cantprest = $_POST[cantpres];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("col_codigo", "cola", "col_viccodigo=$vicec and col_TPPREST=$tpprest");
		if ($consul>0){
			paraTodos::showMsg("Ya existe una configuración de Cola para este tipo de prestamo en este vicerrectorado", "alert-danger");
		} else{
			paraTodos::arrayInserte("col_viccodigo, col_TPPREST, col_cantidad", "cola", "$vicec, $tpprest, $cantprest");
		}
	}
	/*UPDATE*/
	if($editar == 1 and $vicec !=''){
		$consul = paraTodos::arrayConsultanum("*", "cola", "col_viccodigo=$vicec and col_TPPREST=$tpprest and col_codigo<>$codigo");
		if ($consul>0){
			paraTodos::showMsg("Ya existe una configuración de Cola para este tipo de prestamo en este vicerrectorado", "alert-danger");
		} else{
			paraTodos::arrayUpdate("col_viccodigo=$vicec, col_TPPREST=$tpprest, col_cantidad=$cantprest", "cola", "col_codigo=$codigo");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $vicec ==''){
		$consulta = paraTodos::arrayConsulta("*", "cola c", "c.col_codigo=$codigo");
		foreach($consulta as $row){
			$vicec = $row[col_viccodigo];
			$tpprest = $row[col_TPPREST];
			$cantprest = $row[col_cantidad];
		}
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("col_codigo=$codigo", "cola");
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Configuración de la cola de prestamos</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal">
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="nombre">Vicerrectorado</label>
						<div class="col-sm-8">
							<select class="form-control" id="vicec">
								<option>Seleccione el Vicerrectorado</option>
								<?php
									combos::CombosSelect(0, $vicec, "vic_descripcion, vic_codigo", "vicerrectorado", "vic_codigo", "vic_descripcion", "vic_codigo>0");
								?>
							</select>
							<input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo;?>">
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="tpprest">Tipo de Prestamo</label>
						<div class="col-sm-8">
							<select class="form-control" id="tpprest">
								<option>Seleccione el tipo de prestamo</option>
								<?php
									combos::CombosSelect(0, $tpprest, "NAME, ID", "tp_prest", "ID", "NAME", "ID>0");
								?>
							</select>
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="cantpres">Cant. de prestamos Disponibles</label>
						<div class="col-sm-8">
							<input class="form-control" id="cantpres" type="number" min="1" value="<?php echo $cantprest;?>">
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
									vicec 	: $('#vicec').val(),
									tpprest : $('#tpprest').val(),
									cantpres: $('#cantpres').val(),
									insertar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#codigo').val('');
									$('#cantpres').val('');
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
									vicec 	: $('#vicec').val(),
									tpprest : $('#tpprest').val(),
									cantpres: $('#cantpres').val(),
									editar 	: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#cantpres').val('');
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
                <table class="table table-hover" id="vicerrectorados">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Vicerectorado</strong></td>
                            <td class="text-center"><strong>Tipo de Prestamo</strong></td>
                            <td class="text-center"><strong>Cant. Disponible</strong></td>
                            <td class="text-center"><strong>Editar</strong></td>
                            <td class="text-center"><strong>Eliminar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
								$consulsol = paraTodos::arrayConsulta("*", "cola c, vicerrectorado v, tp_prest tp", "c.col_viccodigo=v.vic_codigo and c.col_TPPREST=tp.ID");
								foreach($consulsol as $row){
							?>
                        <tr>
								<td class="text-center"><?php echo $row[vic_descripcion];?></td>
								<td class="text-center"><?php echo $row[NAME];?></td>
								<td class="text-center"><?php echo $row[col_cantidad];?></td>
								<td class="text-center">
									<a href="javascript:void(0);" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: <?php echo $row[col_codigo];?>,
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
									codigo 	: <?php echo $row[col_codigo];?>,
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
		$('#vicerrectorados').DataTable({
			"language": {
				"url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
        	}
		});
</script>
