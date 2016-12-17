<?php
$datosPrestamos = Prestamos::verPrestamos();
?>

<div class="box box-solid box-warning">
    <div class="box-header">
        <h3 class="box-title">Prestamos a su nombre</h3> </div>
        <div class="col-xs-12 box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" align="center"><strong>Cancelado</strong></td>
                        <td colspan="2" align="center"><strong>Pendiente</strong></td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <td align="right"><strong>Prestamo</strong></td>
                        <td><strong>Tipo de Prestamo</strong></td>
                        <td align="right"><strong>Fecha</strong></td>
                        <td align="right"><strong>Monto</strong></td>
                        <td align="right"><strong>Normal</strong></td>
                        <td align="right"><strong>Especial</strong></td>
                        <td align="right"><strong>Normal</strong></td>
                        <td align="right"><strong>Especial</strong></td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($datosPrestamos as $key) {
                        $i ++;
                        $rows[$i] = $key;
                        ?>

                    <tr>
                        <td align="right"><?php echo $rows[$i][CEDULA];?></td>
                        <td> <a href="/users/3046/loans/36857">
                            <?php echo $rows[$i][NAME];?>
                        </a> </td>
                        <td align="right"><?php echo $rows[$i][CREADO_EL];?></td>
                        <td align="right"><?php echo number_format($rows[$i][SOLICITADO], 2, ',', '.');?></td>
                        <td align="right">12.156,63 </td>
                        <td align="right"><?php echo number_format($rows[$i][CANC_ESP],2,',','.');?> </td>
                        <td align="right">7.767,62 </td>
                        <td align="right">0,00 </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tbody>
                    <tr>
                        <td></td>
                        <td><strong>Total prestamos que afectan disponibilidad</strong></td>
                        <td></td>
                        <td align="right"><strong>27.500,00 </strong></td>
                        <td align="right"><strong>23.851,48 </strong></td>
                        <td align="right"><strong>0,00 </strong></td>
                        <td align="right"><strong>8.421,47 </strong></td>
                        <td align="right"><strong>0,00 </strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
</div>
</div>
