<?php
	$codigo = $_POST[codigo];
	$nombre = $_POST[nombre];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("vic_descripcion", "vicerrectorado", "vic_descripcion='$nombre'");
		if ($consul>0){
			paraTodos::showMsg("Este vicerectorado ya esta registrado", "alert-danger");
		} else{
			paraTodos::arrayInserte("vic_descripcion", "vicerrectorado", "'$nombre'");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $nombre ==""){
		$consulta = paraTodos::arrayConsulta("*", "vicerrectorado v", "v.vic_codigo=$codigo");
		foreach($consulta as $row){
			$nombre = $row[vic_descripcion];
		}
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		paraTodos::arrayUpdate("vic_descripcion='$nombre'", "vicerrectorado", "vic_codigo=$codigo");
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("vic_codigo=$codigo", "vicerrectorado");
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Vicerrectorados</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal">
					<div class="form-group" style="display: block;">
						<label class="col-sm-4 control-label" for="nombre">Descripción</label>
						<div class="col-sm-8">
							<input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>">
							<input class="form-control collapse" id="codigo" type="text" value="<?php echo $codigo;?>">
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
									insertar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#codigo').val('');
									$('#nombre').val('');
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
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#codigo').val('');
									$('#nombre').val('');
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
                            <td class="text-center"><strong>Descripcion</strong></td>
                            <td class="text-center"><strong>Editar</strong></td>
                            <td class="text-center"><strong>Eliminar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
								$consulsol = paraTodos::arrayConsulta("*", "vicerrectorado v", "1=1");
								foreach($consulsol as $row){
							?>
                        <tr>
								<td class="text-center"><?php echo $row[vic_descripcion];?></td>
								<td class="text-center">
									<a href="javascript:void(0);" onclick="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									codigo 	: <?php echo $row[vic_codigo];?>,
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
									codigo 	: <?php echo $row[vic_codigo];?>,
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
