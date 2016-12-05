<div id="actualizar">
<input id="archivo" name="archivo" type="file" class="file">
<input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="													
													var inputFileImage = document.getElementById('archivo');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/upload/upload.php';													
													$.ajax({
														url:url,
														ajaxSend: $('#actualizar').html(cargando),														
														type:'POST',
														contentType:false,
														data:data,
														processData:false,
														success : function (html) {
															$('#actualizar').html(html);
														}
													});	">
</div>