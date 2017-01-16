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
				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning">3</span> </a>
					<ul class="dropdown-menu">
						<li class="header">Notificaciónes</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
								<ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
									<li>
										<a href="#"> <i class="fa fa-users text-red"></i> Su puesto en la cola es </a>
									</li>
									<li>
										<a href="#"> <i class="glyphicon glyphicon-ok text-red"></i> Su solicitud ha sido Aprobada </a>
									</li>
									<li>
										<a href="#"> <i class="glyphicon glyphicon-remove text-red"></i> Su solicitud ha sido Rechazada </a>
									</li>
								</ul>
								<div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
								<div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
							</div>
						</li>
					</ul>
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