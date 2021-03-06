<?php
	$dmn = $_POST['dmn'];
?>
    <div id="actualizar"></div>
    <div class="box box-solid box-warning">
        <div class="box-header">
            <h3 class="box-title">Importar Datos de Tipo de Prestamos</h3>
            <div class="box-tools pull-right"> </div>
        </div>
        <div class="box-body">
            <input id="archivo" name="archivo" type="file" class="file form-control">
            <input id="botonSubidor" type="button" class="btn btn-default" value="Actualizar" onclick="
													var inputFileImage = document.getElementById('archivo');
													var file = inputFileImage.files[0];
													var data = new FormData();
													data.append('archivo',file);
													var url = '<?php echo $ruta_base;?>assets/upload/tprest/upload.php';
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
													});	"> </div>
        <!-- /.box-body -->
    </div>
    <div class="box box-solid box-warning">
        <div class="box-header">
            <h3 class="box-title">Tipos de Prestamos</h3>
            <div class="box-tools pull-right"> </div>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th>Nombre</th>
                        <th>Intereses</th>
                        <th>Cuotas</th>
                        <th>Monto Max.</th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php
						$asoc = paraTodos::arrayconsulta("*", "tp_prest p", "1=1");
						foreach ($asoc as $row){
					?>
                        <tr class="odd">
                            <td class=" sorting_1">
                                <?php echo $row[NAME];?>
                            </td>
                            <td class=" sorting_1">
                                <?php echo $row[INTERES];?>
                            </td>
                            <td class=" sorting_1">
                                <?php echo $row[CUONTAS];?>
                            </td>
                            <td class=" sorting_1">
                                <?php echo $row[MTO_MAX];?>
                            </td>
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
        $(function () {
            $("#example1").dataTable();
        });
    </script>
