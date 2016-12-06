<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image"> <img src="<?php echo $ruta_base;?>assets/img/avatar3.png" class="img-circle" alt="User Image" /> </div>
            <div class="pull-left info">
                <p>Hola, <?php echo $_SESSION['nombre_usuario'];?></p> <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a> </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php menu::menuEmpMenj($quien,$nivel); ?>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>