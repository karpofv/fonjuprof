<section class="content invoice">
	<div class="row">
		<div class="box box-solid box-warning">
			<div class="box-header">
				<h3 class="box-title">Notificaciones Recibidas</h3> </div>
			<div class="col-xs-12 box-body table-responsive no-padding">
				<table class="table table-hover" id="tbnotif">
					<thead>
						<tr>
							<td class="text-center"><strong>Fecha</strong></td>
							<td><strong>Notificación</strong></td>
						</tr>
					</thead>
					<tbody>
						<?php
								$consulsol = paraTodos::arrayConsulta("*", "notificacion", "notif_cedula=$_SESSION[ci] and notif_descripcion<>'' order by notif_fecha");
								foreach($consulsol as $row){
							?>
							<tr id="tr<?php echo $row[notif_codigo];?>">
								<td class="text-center">
									<?php echo paraTodos::convertDate($row[notif_fecha]);?>
								</td>
								<td>
									<?php echo $row[notif_descripcion];?>
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
	$('#tbnotif').DataTable({
		"language": {
			"url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
		}
	});
</script>
