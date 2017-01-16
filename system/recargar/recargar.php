<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
	$consul = paraTodos::arrayConsulta("*", "recargar", "id=$idMenut");
	foreach ($consul as $row){
		$opcion = $row[actd];
	}
	if($opcion == '1'){
		$consul = paraTodos::arrayConsulta("*", "tp_prest", "ID =$_POST[tiposol]");
		foreach( $consul as $row){
?>
			<div class="form-group" style="display: block;">
				<label class="col-sm-4 control-label" for="cuotas">Tiempo en Meses</label>
				<div class="col-sm-8">
					<input class="form-control" readonly="readonly" id="cuotas" type="number" value="<?php echo $row['CUONTAS'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="montomax">Monto Maximo</label>
				<div class="col-sm-8">
					<input class="form-control" placeholder="Monto Maximo" readonly="readonly" id="montomax" type="number" value="<?php echo $row['MTO_MAX'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="tasa">Tasa de Interes</label>
				<div class="col-sm-8">
					<input class="form-control" placeholder="Tasa de Interes" readonly="readonly" id="tasa" type="number" value="<?php echo $row['INTERES'];?>">
				</div>
			</div>			
<?php
		}
	}

?>