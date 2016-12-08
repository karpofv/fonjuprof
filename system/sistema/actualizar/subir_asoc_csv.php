<?php
	$dmn = $_POST['dmn'];
?>
	<div id="actualizar"></div>
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h3 class="box-title">Importar Datos de Asociados</h3>
			<div class="box-tools pull-right"> </div>
		</div>
		<div class="box-body">
			<input id="archivo" name="archivo" type="file" class="file form-control">
			<input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="													
													var inputFileImage = document.getElementById('archivo');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/upload/asoc/upload.php';													
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
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h3 class="box-title">Asociados</h3>
			<div class="box-tools pull-right"> </div>
		</div>
		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
            	<thead>
                	<tr role="row">
						<th>Cédula</th>                	
						<th>Nombres y Apellidos</th>                	
						<th>Teléfono</th>                	
						<th>Correo</th>                	
						<th>Origen</th>                	
						<th>Ahorrado</th>                	
						<th>Deuda</th>                	
						<th>Finanzas</th>                	
                	</tr>
                </thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
						$asoc = paraTodos::arrayconsulta("*", "asoc", "1=1");
						foreach ($asoc as $row){
					?>
					<tr class="odd">
						<td class=" sorting_1"><?php echo $row[CEDULA];?></td>
						<td class=" sorting_1"><?php echo utf8_encode($row[NAME]);?></td>
						<td class=" sorting_1"><?php echo $row[TELEFONO];?></td>
						<td class=" sorting_1"><?php echo utf8_encode($row[CORREO]);?></td>
						<td class=" sorting_1"><?php echo $row[ORIGEN];?></td>
						<td class=" sorting_1"><?php echo $row[AHORRADO];?></td>
						<td class=" sorting_1"><?php echo $row[DEUDA];?></td>
						<td class=" sorting_1"><?php echo $row[FIANZAS];?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
            });
        </script>