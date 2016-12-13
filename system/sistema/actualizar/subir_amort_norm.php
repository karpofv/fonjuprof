<?php
	$dmn = $_POST['dmn'];
?>
	<div id="actualizar"></div>
	<div class="box box-solid box-warning">
		<div class="box-header">
<<<<<<< HEAD
			<h3 class="box-title">Importar Datos de Amortizaciones Normales</h3>
=======
			<h3 class="box-title">Importar Datos de Asociados</h3>
>>>>>>> master
			<div class="box-tools pull-right"> </div>
		</div>
		<div class="box-body">
			<input id="archivo" name="archivo" type="file" class="file form-control">
			<input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="													
													var inputFileImage = document.getElementById('archivo');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/upload/amortnorm/upload.php';													
													$.ajax({
														url:url,
														ajaxSend: $('#actualizar').html(cargando),														
														type:'POST',
														contentType:false,
														data:data,
														processData:false,
														success : function (msg) {
															$('#actualizar').html(msg);
														},
													}).fail( function() {
														$.ajax({
        			 										type: 'POST',
        			 										url: 'accion.php',
        													data: {dmn: <?php echo $dmn; ?>, ver:2},
        													success: function(html) {
        														$('#page-content').html(html);	
        													},error: function(xhr,msg,excep) {
        														alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep);
        													}
        												});
													});	"> 
		</div>
		<!-- /.box-body -->
	</div>
	