<?php
	$tipo = $_POST['tipo'];
	$monto = $_POST['monto'];
	$amort = $_POST['amort'];
	$eliminar = $_POST['eliminar'];
	$codigo = $_POST['codigo'];
	$fecha = date('Y-m-j');
	$nuevafecha = strtotime ( '-6 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    /*Se verifica si el asociado posee los datos actualizados*/
	$actualizado = paraTodos::arrayConsultanum("*", "datosper_act", "datac_cedula=$_SESSION[ci]");
    /* consultamos el vicerrectorado al que pertenece el asociado*/
	$consulta = paraTodos::arrayConsulta("*", "datos_per", "datp_cedula=$_SESSION[ci]");
	foreach($consulta as $row){
		$vicec = $row[datp_viccodigo];
	}
    /*Insertamos la solicitud*/
	if ($eliminar =='' and $tipo>'0'){
        /*Se valida aun existan cupos en la cola*/
        $validacupo = paraTodos::arrayConsultanum("*", "cola c,tp_prest tp", "c.col_viccodigo=$vicec and (select count(dp.datp_viccodigo)
from solict_prest s, datos_per dp
where s.CEDULA=dp.datp_cedula and dp.datp_viccodigo=$vicec and s.ESTATUS<>'RECHAZADO' and s.ESTATUS<>'ELIMINADO')<c.col_cantidad and c.col_TPPREST=tp.ID");
        if($validacupo > 0){
            /*Consultamos los datos del asociado*/
            $consulta = paraTodos::arrayConsulta("*", "datos_per", "datp_cedula=$_SESSION[ci]");
            foreach($consulta as $row){
                $asoc = $row[datp_codigo];
                $nombre_asoc = $row[datp_nombres]." ".$row[datp_apellidos];
            }
            /*Consultamos los datos del tipo de prestamo*/
            $consultap = paraTodos::arrayConsulta("*", "tp_prest", "ID=$tipo");
            foreach($consultap as $row){
                $total = $monto;
                $monto_cuota =$total/$row[CUONTAS];
            }
            /*Se valida se halla elegido una forma de amortizacion*/
            if ($amort>0){
                $result =paraTodos::arrayInserte("CEDULA, ASOC, TP_PREST, ESTATUS, NAME, FECHA, MONTO, MTO_X_CTA, OBSV", "solict_prest", "'$_SESSION[ci]', '$asoc', '$tipo', 'EN PROCESO', '$nombre_asoc', CURRENT_DATE, '$total','$monto_cuota', '$amort'");
            } else {
                paraTodos::showMsg("Debe Seleccionar la forma de pago", "alert-danger");
            }
        } else {
            paraTodos::showMsg("Lo sentimos los cupos para este tipo de prestamos se han agotado.", "alert-danger");
        }
	}
    /*Eliminamos la solicitud*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("ID=$codigo", "solict_prest");
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Nueva Solicitud</h3> </div>
            <div class="box-body pad">
               <?php
					if($actualizado>0){
						$consul = paraTodos::arrayConsulta("max(datac_fecha) as fecha", "datosper_act", "datac_cedula=$_SESSION[ci]");
						foreach($consul as $row){
							$ultact = $row[fecha];
						}
						if ($ultact>$nuevafecha){
				?>
                <form class="form-horizontal">
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="tipsol">Tipo de prestamo</label>
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
								combos::CombosSelect(1, "ID", "tp.NAME, tp.ID", "cola c,tp_prest tp", "ID", "NAME", "c.col_viccodigo=$vicec and (select count(dp.datp_viccodigo)
from solict_prest s, datos_per dp
where s.CEDULA=dp.datp_cedula and dp.datp_viccodigo=$vicec and s.ESTATUS<>'RECHAZADO' and s.ESTATUS<>'ELIMINADO')<c.col_cantidad and c.col_TPPREST=tp.ID");
								?>
                            </select>
                        </div>
                    </div>
                    <div id="result">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="montomax">Monto Maximo</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="Monto Maximo" readonly="readonly" id="montomax" type="number">
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
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="amort">Forma de pago</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="amort">
                                <option value="0">Seleccione la forma de pago</option>
                            <?php
								combos::CombosSelect(1, "$amort", "amort_codigo, amort_descripcion", "amort", "amort_codigo", "amort_descripcion", "1=1");
								?>
                            </select>
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
									amort 	: $('#amort').val(),
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							}); return false;"> 
                    </div>
                </form>
                <?php
						} else {
							paraTodos::showMsg("Debe actualizar sus datos antes de realizar una nueva solicitud.", "alert-danger");
						}
					} else {
						paraTodos::showMsg("Debe actualizar sus datos antes de realizar una nueva solicitud.", "alert-danger");
					}
				?>
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
                            <td class="text-center"><strong>Form. Pago</strong></td>
                            <td class="text-center"><strong>Estado</strong></td>
                            <td class="text-center"><strong>Cancelar</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
								$consulsol = paraTodos::arrayConsulta("sp.ID, tp.NAME, sp.FECHA, sp.MONTO, sp.ESTATUS, a.amort_descripcion", "solict_prest sp, tp_prest tp, amort a", "sp.OBSV=a.amort_codigo and sp.TP_PREST=tp.ID and CEDULA=$_SESSION[ci] and sp.ESTATUS<>'ELIMINADO'");
								foreach($consulsol as $row){
							?>
                        <tr>							
								<td class="text-center"><?php echo $row[ID];?></td>
								<td class="text-center"><?php echo $row[NAME];?></td>
								<td class="text-center"><?php echo paraTodos::convertDate($row[FECHA]);?></td>
								<td class="text-center"><?php echo number_format ( $row[MONTO],2, ',','.' );?></td>
								<td class="text-center"><?php echo $row[amort_descripcion];?></td>
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
		} else {
			$("#alerta-msg").fadeOut(1000);
			$("#alerta-msg").addClass("collapse");			
			$("#enviar").removeClass("collapse");
		}
	}
</script>
