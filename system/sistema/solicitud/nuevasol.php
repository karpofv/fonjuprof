<?php
	$tipo = $_POST['tipo'];
	$monto = $_POST['monto'];
	$eliminar = $_POST['eliminar'];
	$codigo = $_POST['codigo'];
	if ($eliminar =='' and $tipo>'0'){
		$consulta = paraTodos::arrayConsulta("*", "asoc", "CEDULA=$_SESSION[ci]");
		foreach($consulta as $row){
			$asoc = $row[ID];
			$nombre_asoc = $row[NAME];
		}
		$consultap = paraTodos::arrayConsulta("*", "tp_prest", "ID=$tipo");
		foreach($consultap as $row){
			$total = $monto+($monto*($row[INTERES]/100));
			$monto_cuota =$total/$row[CUONTAS];
		}
		$result =paraTodos::arrayInserte("CEDULA, ASOC, TP_PREST, ESTATUS, NAME, FECHA, MONTO, MTO_X_CTA", "solict_prest", "'$_SESSION[ci]', '$asoc', '$tipo', 'EN PROCESO', '$nombre_asoc', CURRENT_DATE, '$total','$monto_cuota'");
	}
	if ($eliminar !=''){
		paraTodos::arrayUpdate("ESTATUS='ELIMINADO'", "solict_prest", "ID=$codigo");		
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Nueva Solicitud</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal">
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="solicitud_Tipo de Prestamo">Tipo de prestamo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="tipsol" onchange="
							$('#total').val('');
							$('#monto_cuota').val('');
							$('#montosol').val('');
                            $.ajax({
								url:'accion.php',
								type:'POST',
								ajaxSend: $('#result').html(cargando),								
								data:{
									dmn 	: 354,
									tiposol : $('#tipsol').val(),
									ver 	: 1
								},
								success : function (html) {
									$('#result').html(html);
								},
							});"> 
                                <option value="0">Seleccione tipo de Prestamo</option>
                            <?php
								combos::CombosSelect(1, "ID", "*", "tp_prest", "ID", "NAME", "MTO_MAX>0");
								?>
                            </select>
                        </div>
                    </div>
                    <div id="result">
						<div class="form-group" style="display: block;">
							<label class="col-sm-4 control-label" for="cuotas">Tiempo en Meses</label>
							<div class="col-sm-8">
								<input class="form-control" readonly="readonly" id="cuotas" type="number">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="montomax">Monto Maximo</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Monto Maximo" readonly="readonly" id="montomax" type="number">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="tasa">Tasa de Interes</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Tasa de Interes" readonly="readonly" id="tasa" type="number">
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="montosol">Monto</label>
                        <div class="col-sm-7">
                            <input class="form-control" placeholder="Monto" id="montosol" type="number" onchange="verificar();">
						</div>
						<div class="col-sm-1">
                            <a href="javascript:void(0);" class="badge bg-orange"><i class="glyphicon glyphicon-ok" style="color: green"></i></a>
                    	</div>                   
                    </div>
                    <div class="form-group" id="monto_cuotas" style="display: block;">
                        <label class="col-sm-4 control-label" for="monto_cuota">Monto por cuota</label>
                        <div class="col-sm-8">
                            <input class="form-control" placeholder="Monto por cuota" id="monto_cuota" type="number" readonly>
                    	</div>
					</div>
					<div class="form-group" style="display: block;">
                        <label class="col-sm-4 control-label" for="total">Monto Total</label>
                        <div class="col-sm-8">
                            <input class="form-control" placeholder="Total a Cancelar" id="total" type="number" readonly>
                    	</div>
					</div>
                    <div class="box-footer">
                        <input id="enviar" type="button" value="Enviar Solicitud" class="btn btn-primary col-md-offset-5 collapse" onclick="
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									tipo 	: $('#tipsol').val(),
									monto 	: $('#montosol').val(),
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;"> 
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Solicitudes Realizadas</h3> </div>
            <div class="col-xs-12 box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Solicitud</strong></td>
                            <td class="text-center"><strong>Tipo de Prestamo</strong></td>
                            <td class="text-center"><strong>Fecha</strong></td>
                            <td class="text-center"><strong>Monto</strong></td>
                            <td class="text-center"><strong>Estado</strong></td>
                            <td class="text-center"><strong>Cancelar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
								$consulsol = paraTodos::arrayConsulta("sp.ID, tp.NAME, sp.FECHA, sp.MONTO, sp.ESTATUS", "solict_prest sp, tp_prest tp", " sp.TP_PREST=tp.ID and CEDULA=$_SESSION[ci] and sp.ESTATUS<>'ELIMINADO'");
								foreach($consulsol as $row){
							?>
                        <tr>							
								<td class="text-center"><?php echo $row[ID];?></td>
								<td class="text-center"><?php echo $row[NAME];?></td>
								<td class="text-center"><?php echo $row[FECHA];?></td>
								<td class="text-center"><?php echo $row[MONTO];?></td>
								<td class="text-center"><?php echo $row[ESTATUS];?></td>
								<td class="text-center">								
								<?php
									if($row[ESTATUS] == 'EN PROCESO'){
								?>
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
							}); return false;"><i class="glyphicon glyphicon-minus
 btn-xs"></i>
									</a>
							<?php
									}
								?>
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
	function verificar(){
		if(parseFloat($("#montosol").val())>parseFloat($("#montomax").val())){
			$("#alerta-msg").fadeIn(1000);
			$("#alerta-msg").removeClass("collapse");
			$("#alert-msg").html("Monto Solicitado Excede el Monto Maximo");
			$("#enviar").addClass("collapse");			
			$("#total").val('');
			$("#monto_cuota").val('');
		} else {
			$("#alerta-msg").fadeOut(1000);
			$("#alerta-msg").addClass("collapse");			
			$("#enviar").removeClass("collapse");
			$("#total").val(parseFloat($("#montosol").val())+(parseFloat($("#montosol").val()*($("#tasa").val()/100))));
			$("#monto_cuota").val(parseFloat($("#montosol").val())/parseFloat($("#cuotas").val()));
		}
	}
</script>