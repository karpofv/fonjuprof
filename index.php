<?php
include_once 'includes/layout/head.php';
require 'includes/conf/general_parameters.php';
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
if ($_GET[logaut] == '1') {
  session_cache_limiter('nocache,private');
  session_name($sess_name);
  session_start();
  $sid = session_id();
  session_destroy();
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>

<div class="form-box" id="login-box">
  <div id="banner" class="fondo"></div>
  <div class="center-content">
    <form action="index2.php" id="login-validation" class="col-md-12 center-margin" method="post" enctype="multipart/form-data">
      <!-- notificacion de error -->
      <?php if (isset($_GET['error_login'])) {
        $error = $_GET['error_login']; ?>
        <ul class="noty-wrapper i-am-new" id="noty_bottom">
          <li class="bg-red" style="cursor: pointer;">
            <div class="noty_bar" id="noty_1047669272175724900">
              <div class="noty_message">
                <span class="noty_text">
                  <i class="glyph-icon icon-cog mrg5R"></i><?php echo $error_login_ms[$error]; ?>
                </span>
              </div>
            </div>
          </li>
        </ul>
        <?php

      }
      ?>
      <!-- fin notificacion de error -->
      <div id="login-form" class="content-box bg-default">
        <div class="content-box-wrapper pad20A">
          <!--  <img class="mrg25B center-margin radius-all-100 display-block" id="icon_perfil" src="assets/images/icono_perfil.gif" alt="">
        -->
        <br>
        <div class="form-group">
          <div class="input-group"> <span class="input-group-addon addon-inside bg-gray">
            <i class="glyph-icon icon-user"></i>
          </span>
          <input title="Ingrese su Usuario de Acceso" type="text" name="user" id="user" class="form-control" id="exampleInputEmail1" placeholder="Ingresa tu usuario" required="required"> </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon addon-inside bg-gray">
              <i class="glyph-icon icon-unlock-alt"></i>
            </span>
            <input title="Ingrese su Clave de Acceso" type="password" name="pass" id="pass" class="form-control" id="exampleInputPassword1" placeholder="Ingresa tu clave" required="required">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-block btn-primary">Ingresar</button>
        </div>
        <div class="row">
          <div class="checkbox-primary col-md-6" id="check_remember">
            <label>
              <input type="checkbox" id="loginCheckbox1" class="custom-checkbox"> Recordarme </label>
            </div>
            <div class="text-right col-md-6"> <a href="#" data-toggle="modal" data-target="#myModal" class="switch-button" switch-target="#login-forgot" switch-parent="#login-form" title="Recover password">¿No tienes usuario? <br>Click aqui</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal -->
<form class="form-horizontal" action="login.php" method="post">
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Registrar usuario nuevo</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="solicitud_Monto">Cedula</label><div id="Info"></div>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Ejem: 1234567" id="cedula" type="text" name="cedula" required>
            </div>
          </div>
          <div class="form-group" id="monto_cuotas" style="display: block;">
            <label class="col-sm-4 control-label" for="solicitud_Monto por cuota">Usuario</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Ejem: unellez" id="usuario" type="text" name="usuario" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="solicitud_Observaciones">Contraseña</label>
            <div class="col-sm-8">
              <input class="form-control" type="password" id="contrasena" name="contrasena" value="" placeholder="******" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="solicitud_Observaciones">Repita Contraseña</label>
            <div class="col-sm-8">
              <input class="form-control" type="password" id="recontrasena" name="recontrasena" value="" placeholder="******" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<?php
include_once("includes/layout/foot.php");
?>
