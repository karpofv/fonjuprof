<?php
	Notificaciones::notificacion($_SESSION[ci]);
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bell-o"></i> <span class="label label-warning"><?php Notificaciones::numnotif($_SESSION[ci]);?></span>
</a>
<ul class="dropdown-menu">
    <li class="header"><b>Notificaciónes</b></li>
    <li>
        <!-- inner menu: contains the actual data -->
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
            <ul class="menu" style="overflow-y: scroll; width: 100%; height: 200px;">
                <?php
 					Notificaciones::notif($_SESSION[ci]);
                ?>
            </ul>
            <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;"></div>
            <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">s</div>
        </div>
    </li>
    <li class="footer"><a href="javascript:void(0)">Ver Todas</a></li>
</ul>
