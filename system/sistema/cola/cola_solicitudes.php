<?php
	$codigo = $_POST[codigo];
	$vicec = $_POST[vicec];
	$tpprest = $_POST[tpprest];
	$cantprest = $_POST[cantpres];
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
    $dmn = $_POST[dmn];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("col_codigo", "cola", "col_viccodigo=$vicec and col_TPPREST=$tpprest");
		if ($consul>0){
			paraTodos::showMsg("Ya existe una configuración de Cola para este tipo de prestamo en este vicerrectorado", "alert-danger");
		} else{
			paraTodos::arrayInserte("col_viccodigo, col_TPPREST, col_cantidad", "cola", "$vicec, $tpprest, $cantprest");
		}
	}
	/*UPDATE*/
	if($editar == 1 and $vicec !=''){
		$consul = paraTodos::arrayConsultanum("*", "cola", "col_viccodigo=$vicec and col_TPPREST=$tpprest and col_codigo<>$codigo");
		if ($consul>0){
			paraTodos::showMsg("Ya existe una configuración de Cola para este tipo de prestamo en este vicerrectorado", "alert-danger");
		} else{
			paraTodos::arrayUpdate("col_viccodigo=$vicec, col_TPPREST=$tpprest, col_cantidad=$cantprest", "cola", "col_codigo=$codigo");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $vicec ==''){
		$consulta = paraTodos::arrayConsulta("*", "cola c", "c.col_codigo=$codigo");
		foreach($consulta as $row){
			$vicec = $row[col_viccodigo];
			$tpprest = $row[col_TPPREST];
			$cantprest = $row[col_cantidad];
		}
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("col_codigo=$codigo", "cola");
	}
?>
   <section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Cola de Solicitudes de Prestamos</h3>
                <h3 class="box-title pull-right"><a href="<?php echo $ruta_base."system/accion.php?dmn=157&act=2&ver=2"?>" target="_blank"><i class="fa fa-print"></i>Imprimir todo</a></h3></div>
            <div class="col-xs-12 box-body table-responsive no-padding">
                <table class="table table-hover" id="vicerrectorados">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Puesto</strong></td>
                            <td class="text-center"><strong>Fecha</strong></td>
                            <td class="text-center"><strong>Vicerrectorado</strong></td>
                            <td class="text-center"><strong>Cédula</strong></td>
                            <td class="text-center"><strong>Nombre y Apellido</strong></td>
                            <td class="text-center"><strong>Tipo de Prestamo</strong></td>
                            <td class="text-center"><strong>Monto</strong></td>
                            <td class="text-center"><strong>Estatus</strong></td>
                            <td class="text-center"><strong>Aprobar</strong></td>
                            <td class="text-center"><strong>Rechazar</strong></td>
                            <td class="text-center"><strong>Imprimir</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        	<?php
                                $consulvicec = paraTodos::arrayConsulta("*", "vicerrectorado", "1=1");
                                foreach($consulvicec as $row){
                                    $puesto = 0;
                                    $vicecpuesto = $row[vic_codigo];
                                    $consulsol = paraTodos::arrayConsulta("s.ID, s.FECHA, s.CEDULA, s.NAME, s.MONTO, s.ESTATUS, tp.NAME as tipop, v.vic_descripcion", "solict_prest s, tp_prest tp, datos_per dp, vicerrectorado v", "s.TP_PREST=tp.ID and s.CEDULA=dp.datp_cedula and v.vic_codigo=dp.datp_viccodigo and v.vic_codigo=$vicecpuesto and s.ESTATUS<>'APROBADO' and s.ESTATUS<>'RECHAZADO' order by s.ID");
                                    foreach($consulsol as $row){
                                        $puesto=$puesto+1;
                                ?>
                            <tr id="tr<?php echo $row[ID];?>">
                                    <td class="text-center"><?php echo $puesto;?></td>
                                    <td class="text-center"><?php echo paraTodos::convertDate($row[FECHA]);?></td>
                                    <td class="text-center"><?php echo $row[vic_descripcion];?></td>
                                    <td class="text-center"><?php echo $row[CEDULA];?></td>
                                    <td class="text-center"><?php echo utf8_encode($row[NAME]);?></td>
                                    <td class="text-center"><?php echo $row[tipop];?></td>
                                    <td class="text-center"><?php echo number_format ( $row[MONTO],2, ',','.' );?></td>
                                    <td class="text-center"><?php echo $row[ESTATUS];?></td>
                                    <?php
                                        if($row[ESTATUS]<>'APROBADO' and $row[ESTATUS]<>'RECHAZADO'){

                                    ?>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                    url:'accion.php',
                                    type:'POST',
                                    data:{
                                        dmn 	: 357,
                                        codigo 	: <?php echo $row[ID];?>,
                                        estatus : 'APROBADO',
                                        ver 	: 1
                                    },
                                    success : function (html) {
                                        $.ajax({
                                            url:'accion.php',
                                            type:'POST',
                                            data:{
                                                dmn 	: <?php echo $dmn;?>,
                                                ver 	: 2
                                            },
                                            success : function (html) {
                                                $('#page-content').html(html);
                                            },
                                        });
                                    },
                                }); return false;"><i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="$.ajax({
                                    url:'accion.php',
                                    type:'POST',
                                    data:{
                                        dmn 	: 357,
                                        codigo 	: <?php echo $row[ID];?>,
                                        estatus : 'RECHAZADO',
                                        ver 	: 1
                                    },
                                    success : function (html) {
                                        $.ajax({
                                            url:'accion.php',
                                            type:'POST',
                                            data:{
                                                dmn 	: <?php echo $dmn;?>,
                                                ver 	: 2
                                            },
                                            success : function (html) {
                                                $('#page-content').html(html);
                                            },
                                        });
                                    },
                                }); return false;"><i class="fa fa-eraser"></i>
                                        </a>
                                    </td>
                                <?php
                                        } else{
                                            ?>
                                <td></td>
                                <td></td>
                                            <?php
                                        }
                                ?>
                                <td class="text-center"><a href="<?php echo $ruta_base."system/accion.php?dmn=157&act=3&ver=2&id=$row[ID]"?>" target="_blank"><i class="fa fa-print"></i></a></td>
                            </tr>
                                <?php
                                    }
                                }
                                $consulsol = paraTodos::arrayConsulta("s.ID, s.FECHA, s.CEDULA, s.NAME, s.MONTO, s.ESTATUS, tp.NAME as tipop, v.vic_descripcion", "solict_prest s, tp_prest tp, datos_per dp, vicerrectorado v", "s.TP_PREST=tp.ID and s.CEDULA=dp.datp_cedula and v.vic_codigo=dp.datp_viccodigo and (s.ESTATUS='APROBADO' or s.ESTATUS='RECHAZADO')");
                                    foreach($consulsol as $row){
                                ?>
                            <tr id="tr<?php echo $row[ID];?>">
                                    <td class="text-center"><i class="fa fa-certificate font-green"></i></td>
                                    <td class="text-center"><?php echo paraTodos::convertDate($row[FECHA]);?></td>
                                    <td class="text-center"><?php echo $row[vic_descripcion];?></td>
                                    <td class="text-center"><?php echo $row[CEDULA];?></td>
                                    <td class="text-center"><?php echo utf8_encode($row[NAME]);?></td>
                                    <td class="text-center"><?php echo $row[tipop];?></td>
                                    <td class="text-center"><?php echo number_format ( $row[MONTO],2, ',','.' );?></td>
                                    <td class="text-center"><?php echo $row[ESTATUS];?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><a href="<?php echo $ruta_base."system/accion.php?dmn=157&act=3&ver=2&id=$row[ID]"?>" target="_blank"><i class="fa fa-print"></i></a></td>
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
				"url": "<?php echo $ruta_base;?>assets/js/Spanish.json",
        	},
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'print',
                text: 'Imprimir',
                title: '',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '8pt' )
                        .prepend(
                            '<div><div style="float:left; width:120px;"><img src="http://karpofv.ddns.net/fonjuprof/assets/img/logo.jpg" style="width:120px; "></div><div><h5 style="margin-top:0; margin-left:30px">Fundación Fondo de Jubilaciones y Pensiones del Personal Académico<br>de la Universidad Nacional Experimental de los Llanos Occidentales<br>"Ezequiel Zamora"<br>"UNELLEZ"</h5><h4 style="text-align:center">Reporte personalizado de Prestamos solicitados</h4></div></div>'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
            ]
		});
</script>
