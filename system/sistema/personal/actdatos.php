<?php
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $dmn = $_POST['dmn'];
?>
<section class="content-header">
    <h2>Actualizar Datos</h2> </section>
<section>
    <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Datos Personales</h3> 
            </div>
            <form role="form" method="post" action="">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtcedula">Cédula</label>
                        <input type="number" class="form-control" id="txtcedula" value="<?php echo $cedula;?>"> 
                    </div>
                    <div class="form-group">
                        <label for="txtnombre">Nombres y Apellidos</label>
                        <input type="text" class="form-control" id="txtnombre" value="<?php echo $nombre;?>"> 
                    </div>
                    <div class="form-group">
                        <label for="txttelefono">Teléfono</label>
                        <input type="text" class="form-control" id="txttelefono" value="<?php echo $telefono;?>">
                    </div>
                    <div class="form-group">
                        <label for="txtcorreo">Correo</label>
                        <input type="text" class="form-control" id="txtcorreo" value="<?php echo $correo;?>">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</section>