<div class="ventana-modal">
<?php
    $cedula = $_POST[cedula];
    $passw = $_POST[passw];
    if($passw!=""){
        $passw = md5($_POST[passw]);
        $update = paraTodos::arrayUpdate("contrasena='$passw'", "usuarios", "Cedula=$cedula");
        if($update){
            paraTodos::showMsg("Contraseña modificada exitosamente", "alert-success");
        }
    }
?>    
    <form class="form-horizontal" action="javascript:void(0)" method="post" onsubmit="$.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									cedula 	: <?php echo $cedula;?>,
									passw 	: $('#contrasena').val(),
                                    act: 2,
									ver 	: 2
								},
								success : function (html) {
									$('#ventanaVer').html(html);
								},
							}); return false;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4> 
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="solicitud_Monto">Nueva contraseña</label>
                            <div id="Info"></div>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="contrasena" name="contrasena" value="" placeholder="******" required>
                            </div>
                        </div>                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                            <button type="button" class="btn btn-default" onclick="$('#ventanaVer').html('');">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>