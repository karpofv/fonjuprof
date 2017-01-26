<?php
	$cedula = $_SESSION[ci];
	$mostrar = $_POST[mostrar];
	$mostrar = $_POST[mostrar];
	$actualizado = $_POST[actualizado];
    $dmn = $_POST[dmn];
	$consul = paraTodos::arrayConsulta("max(datac_fecha) as fecha", "datosper_act", "datac_cedula=$cedula");
	foreach($consul as $row){
		$ultact = $row[fecha];
	}
	if ($mostrar==1){
		$nombre = $_POST[nombre];
		$apellido = $_POST[apellido];
		$direc = $_POST[direc];
		$telef = $_POST[telef];
		$correo = $_POST[correo];
		$vicec = $_POST[vicec];
		$banco = $_POST[banco];
		$cuenta = $_POST[cuenta];
		$cond = $_POST[condicion];
		$fecing = $_POST[fecing];
		$fecnac = $_POST[fecnac];
		$editar = $_POST[editar];
	} else {
		$consul = paraTodos::arrayConsulta("*", "datos_per", "datp_cedula=$cedula");
		foreach($consul as $row){
			$nombre = $row[datp_nombres];
			$apellido = $row[datp_apellidos];
			$direc = $row[datp_direccion];
			$telef = $row[datp_telefono];
			$correo = $row[datp_correo];
			$banco = $row[datp_banco];
			$cuenta = $row[datp_cuenta];
			$vicec = $row[datp_viccodigo];
			$cond = $row[datp_condcodigo];
			$fecing = $row[datp_fecing];
			$fecnac = $row[datp_fecnac];
		}
	}
	if ($editar !=''){
        if ($nombre=='' || $apellido == ''|| $fecnac == ''|| $direc == ''|| $correo == ''|| $telef == ''|| $fecing == ''|| $banco == ''|| $cuenta == ''){
			paraTodos::showMsg("No se ha podido actualizar verifique los datos suministrados", "alert-danger");
        } else {
            if ($vicec>0){
                if ($cond>0){
                    $consul = paraTodos::arrayConsultanum("*", "datos_per", "datp_cedula=$cedula");
                    if($consul>0){
                        paraTodos::arrayUpdate("datp_nombres='$nombre',datp_apellidos = '$apellido', datp_fecnac='$fecnac', datp_direccion='$direc', datp_correo='$correo', datp_telefono= '$telef', datp_viccodigo=$vicec, datp_condcodigo=$cond, datp_fecing='$fecing', datp_banco='$banco', datp_cuenta=$cuenta", "datos_per", "datp_cedula=$cedula");
                        paraTodos::arrayInserte("datac_cedula, datac_fecha", "datosper_act", "$cedula, current_date");
                        paraTodos::showMsg("Actualización Exitosa", "alert-success");
                    } else{
                        paraTodos::arrayInserte("datp_cedula,datp_nombres,datp_apellidos, datp_fecnac, datp_direccion, datp_correo, datp_telefono, datp_viccodigo, datp_condcodigo, datp_fecing, datp_banco, datp_cuenta", "datos_per", "$cedula, '$nombre', '$apellido', '$fecnac', '$direc', '$correo', '$telef', $vicec, $cond, '$fecing', '$banco', $cuenta");
                        paraTodos::arrayInserte("datac_cedula, datac_fecha", "datosper_act", "$cedula, current_date");
                        paraTodos::showMsg("Actualización Exitosa", "alert-success");
                    }
                } else {
                    paraTodos::showMsg("Debe ingresar su condición", "alert-danger");
                }
            } else {
                paraTodos::showMsg("Debe ingresar el vicerrectorado al que pertenece", "alert-danger");
            }
        }
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Actualizacion de Datos</h3>
                <h5 class="box-title pull-right">Ultima Actualización: <?php echo paraTodos::convertDate($ultact); ?></h5>
			</div>
            <div class="box-body pad">
                <form class="form-horizontal" onsubmit="
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									nombre 	: $('#txtnombre').val(),
									apellido: $('#txtapellido').val(),
									direc 	: $('#txtdirec').val(),
									telef 	: $('#txttelefono').val(),
									correo 	: $('#txtcorreo').val(),
									vicec 	: $('#vicerrec').val(),
									banco 	: $('#txtbanco').val(),
									cuenta 	: $('#txtcuenta').val(),
									condicion 	: $('#txtcond').val(),
									fecnac 	: $('#txtfecnac').val(),
									fecing 	: $('#txtfecing').val(),
									mostrar : 1,
									actualizado : 1,
									editar 	: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
								},
							});return false" action="javascript: void(0);" method="post">
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtnombre">Nombres</label>
                        <div class="col-sm-8">
							<input class="form-control" placeholder="Nombres" id="txtnombre" type="text" value="<?php echo $nombre;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtapellido">Apellidos</label>
                        <div class="col-sm-8">
							<input class="form-control" placeholder="Apellidos" id="txtapellido" type="text" value="<?php echo $apellido;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtdirec">Dirección</label>
                        <div class="col-sm-8">
							<input class="form-control" placeholder="Dirección" id="txtdirec" type="text" value="<?php echo $direc;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txttelefono">Teléfonos</label>
                        <div class="col-sm-8">
							<input class="form-control" placeholder="Teléfonos" id="txttelefono" type="text" value="<?php echo $telef;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtcorreo">Correo Electrónico</label>
                        <div class="col-sm-8">
							<input class="form-control" placeholder="Correo Eléctronico" id="txtcorreo" type="text" value="<?php echo $correo;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtbanco">Banco</label>
                        <div class="col-sm-8">
							<input class="form-control" id="txtbanco" type="text" value="<?php echo $banco;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtcuenta">Nº de cuenta</label>
                        <div class="col-sm-8">
							<input class="form-control" id="txtcuenta" type="number" value="<?php echo $cuenta;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtfecing">Fecha de Ingreso</label>
                        <div class="col-sm-8">
							<input class="form-control" id="txtfecing" type="date" value="<?php echo $fecing;?>" required>
                        </div>
						<label class="col-sm-4 control-label" for="txtfecnac">Fecha de Nacimiento</label>
                        <div class="col-sm-8">
							<input class="form-control" id="txtfecnac" type="date" value="<?php echo $fecnac;?>" required>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="vicerrec">Vicerrectorado</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="vicerrec">
                                <option value="0">Seleccione el Vicerrectorado</option>
                            <?php
								combos::CombosSelect(1, "$vicec", "vic_codigo, vic_descripcion", "vicerrectorado", "vic_codigo", "vic_descripcion", "1=1");
								?>
                            </select>
                        </div>
                    </div>
					<div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="txtcond">Condición</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="txtcond">
                                <option value="0">Seleccione la condición</option>
                            <?php
								combos::CombosSelect(1, "$cond", "cond_codigo, cond_descripcion", "condicion", "cond_codigo", "cond_descripcion", "1=1");
								?>
                            </select>
                        </div>
                    </div>
					<div class="box-footer">
                        <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
