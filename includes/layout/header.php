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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span><?php
                                if (strlen($datosPersonales[NAME]) > 17) {
                                    echo $empresaNomb = substr($datosPersonales[NAME],0,17).'...';
                                } else {
                                    echo $empresaNomb = $datosEmp[0][nomemp];
                                }
                                ?> <i class="caret"></i></span> </a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue"> <img src="<?php echo $ruta_base;?>assets/img/avatar3.png" class="img-circle" alt="User Image" />
							<p>
								<?php
                                if (strlen($datosPersonales[NAME]) > 17) {
                                    echo $empresaNomb = substr($datosPersonales[NAME],0,17).'...';
                                } else {
                                    echo $empresaNomb = $datosEmp[0][nomemp];
                                }
                                ?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left"> <a href="#" class="btn btn-default btn-flat">Mis Datos</a> </div>
							<div class="pull-right"> <a href="accion.php?salir=1" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>S</u>alir</strong></a> </div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>