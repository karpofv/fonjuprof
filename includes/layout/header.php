<?php
	$ruta=$absolute_uri."assets/img/fotos/$_SESSION[ci].jpg";
	$existe = paraTodos::url_exists($ruta);
	if ($existe==true){
		$ruta = $ruta;
	} else {
		$ruta=$absolute_uri."assets/img/fotos/avatar3.jpg";
	}
	$consuldper = paraTodos::arrayConsultanum("*", "datos_per", "datp_cedula=$_SESSION[ci]");
	if ($consuldper>0){
		$consul = paraTodos::arrayConsulta("*", "datos_per dp, vicerrectorado v, condicion c", " dp.datp_viccodigo=v.vic_codigo and dp.datp_condcodigo=c.cond_codigo and datp_cedula=$_SESSION[ci]");
		foreach($consul as $row){
			$name = $row[datp_nombres]." ".$row[datp_apellidos];
		}
	} else {
			$name = $datosPersonales[NAME];
	}
?>
<header class="header">
	<a href="accion.php" class="logo">
		<!-- Add the class icon to your logo image or logo icon to add the margining -->FONJUPROF </a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="dropdown notifications-menu">
					<a href="accion.php"> <i class="glyphicon glyphicon-home"></i></a>
				</li>				
				<li class="dropdown notifications-menu" id="notificaciones">
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <span><?php
                                if (strlen($name) > 17) {
                                    echo $empresaNomb = substr($name,0,17).'...';
                                } else {
                                    echo $empresaNomb = $name;
                                }
                                ?> <i class="caret"></i></span> </a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue">
						<img src="<?php echo $ruta;?>" class="img-circle" alt="User Image" />
						<p><a href="#" onclick="													$.ajax({
        			 									type: 'POST',
        			 									url: 'accion.php',
        												data: {
        													dmn :150,
        													act : 2,
        													ver : 2
        												},
        												success: function(html) {
        													$('#ventanaVer').html(html);
        												},
        												error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
        											});">Actualizar Foto</a></p>
							<p>
								<?php
                                if (strlen($name) > 17) {
                                    echo $empresaNomb = substr($name,0,17).'...';
                                } else {
                                    echo $empresaNomb = $name;
                                }
                                ?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right"> <a href="accion.php?salir=1" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>S</u>alir</strong></a> </div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
