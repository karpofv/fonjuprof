<?php
	include_once("modelo/estadocuenta/class.estadoc.php");
?>
                  <div class="row invoice-info">
                   <?php
						estadocuenta::resumen_estadodet($_POST[codigo]);
					?>
    </div>
    <div class="row">
		    <div class="box">
	            <div class="box-header">
	                <h3 class="box-title">&nbsp;&nbsp;Cuotas Normales</h3>
	            </div>
		        <div class="col-xs-12 table-responsive no-padding">
		            <table class="table table-hover">
		                <thead>
		                    <tr>
		                        <td align="right"><strong>ID</strong></td>
		                        <td align="right"><strong>Monto</strong></td>
		                        <td align="right"><strong>Tasa</strong></td>
		                        <td align="right"><strong>Vence</strong></td>
		                        <td align="right"><strong>Pagada el</strong></td>
		                        <td align="right"><strong>Cancelado</strong></td>
		                        <td align="right"><strong>Interes</strong></td>
		                        <td align="right"><strong>Abono</strong></td>
		                        <td align="right"><strong>Pago</strong></td>
		                        <td align="right"><strong>Resta</strong></td>
		                    </tr>
		                </thead>
		                <tbody>
                   		<?php
							estadocuenta::estadoc_det($_POST[codigo]);
						?>
		                </tbody>
		            </table>
		        </div><!-- /.col -->
	        </div>
	    </div>