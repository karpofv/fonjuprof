<?php
	$ruta=$absolute_uri."assets/img/fotos/$_SESSION[ci].JPG";
	$existe = paraTodos::url_exists($ruta);
	if ($existe==true){
		$ruta = $ruta;
	} else {
		$ruta=$absolute_uri."assets/img/fotos/avatar3.JPG";
	}
?>
<div class="ventana-modal">
	<section class="content invoice">
		<div class="row">
			<div class="box box-solid box-warning">
				<div class="box-header">
					<h3 class="box-title">Actualizar Fotografia</h3>
					<h3 class="box-title pull-right"><button class="btn bg-white btn-circle" onclick="
      			 									$('#ventanaVer').animate({ opacity: 0 });
      			 									window.location.href = 'accion.php';
       			 									"><i class="fa fa-angle-double-down"></i></button></h3>
				</div>
				<div class="col-xs-6 box-body content-archivo">
					<div tabindex="500" class="btn btn-primary btn-file" id="selarchivo"> <i class="glyphicon glyphicon-folder-open"><span class="">  Seleccione la imagen</span></i>
						<input id="archivoImage<?php echo $_SESSION[ci];?>" name="archivoImage<?php echo $_SESSION[ci];?>" type="file" class="file">
					</div>
					<input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="
													var inputFileImage = document.getElementById('archivoImage<?php echo $_SESSION[ci];?>');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/widgets/upload/upload.php';
													$.ajax({
														url:url,
														type:'POST',
														contentType:false,
														data:data,
														data:data,
														processData:false,
														success : function (msg) {
															$.ajax({
        			 									type: 'POST',
        			 									url: 'accion.php',
        												data: {
        													dmn :150,
        													act : 2,
        													ver : 2
        												},
        												success: function(html) {
        													$('#ventanaVer').html(html);
        												},
        												error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
        											});
														}
													});">
					<h5><b>Nota: </b>* El tamaño de la imagen no deberá ser mayor a 200kb.<br>* El formato de la imagen debera ser .JPG</h5><br>
				</div>
				<div class="col-xs-6 box-body content-archivo" id="foto-actual">
					<img src="<?php echo $ruta."?".rand()?>" class="img-responsive">
				</div>
			</div>
		</div>
	</section>
</div>
