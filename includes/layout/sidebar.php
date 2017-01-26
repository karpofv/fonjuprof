<?php
	$consuldper = paraTodos::arrayConsultanum("*", "datos_per", "datp_cedula=$_SESSION[ci]");
	if ($consuldper>0){
		$consul = paraTodos::arrayConsulta("*", "datos_per dp, vicerrectorado v, condicion c", " dp.datp_viccodigo=v.vic_codigo and dp.datp_condcodigo=c.cond_codigo and datp_cedula=$_SESSION[ci]");
		foreach($consul as $row){
			$name = $row[datp_nombres]." ".$row[datp_apellidos];
		}
	} else {
			$name = $datosPersonales[NAME];
	}
?><!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image"> <img src="<?php echo $ruta?>" class="img-circle" alt="User Image" /> </div>
            <div class="pull-left info">
                <p>Hola, <?php
                                if (strlen($name) > 17) {
                                    echo $empresaNomb = substr($name,0,17).'...';
                                } else {
                                    echo $empresaNomb = $name;
                                }
                                ?></p> <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a> </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php menu::menuEmpMenj($quien,$nivel); ?>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
