<section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Nueva Solicitud</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="solicitud_Tipo de Prestamo">Tipo de prestamo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="loantype" name="solicitud[loantype]">
                                <option value="Corto Plazo">Multiuso</option>
                                <option value="Mediano Plazo">Emergencia Médica</option>
                                <option value="Largo Plazo">Asistencia Social</option>
                                <option value="Largo Plazo">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="cuotas" style="display: block;">
                        <label class="col-sm-4 control-label" for="solicitud_Tiempo">Tiempo</label>
                        <div class="col-sm-8">
                            <input class="form-control" readonly="readonly" id="cuotas_f" type="text" name="solicitud[cuotas]"> </div>
                    </div>
                    <div class="form-group" id="literal_d" style="display: none;">
                        <label class="col-sm-4 control-label" for="solicitud_Literal">Literal</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="porcentaje" name="solicitud[literal]">
                                <option value="80">80%</option>
                                <option value="50">50%</option>
                                <option value="25">25%</option>
                                <option value="20">20%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="solicitud_Disponibilidad">Disponibilidad</label>
                        <div class="col-sm-8">
                            <input class="form-control" placeholder="Disponibilidad" readonly="readonly" value="82.529,00 Bs" id="disp_f" type="text" name="solicitud[Disponibilidad_f]">
                            <input value="82529" id="disp_i" type="hidden" name="solicitud[Dispo1nibilidad_i]">
                            <input class="form-control" placeholder="Disponibilidad" readonly="readonly" value="82529" id="disponibilidad" type="hidden" name="solicitud[Disponibilidad]"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="solicitud_Monto">Monto</label>
                        <div class="col-sm-8">
                            <input class="form-control" placeholder="Monto" id="monto" type="text" name="solicitud[monto]"> </div>
                    </div>
                    <div class="form-group" id="monto_cuotas" style="display: block;">
                        <label class="col-sm-4 control-label" for="solicitud_Monto por cuota">Monto por cuota</label>
                        <div class="col-sm-8">
                            <input class="form-control" placeholder="Monto por cuota" id="monto_cuota" type="text" name="solicitud[monto_cuota]">
                            <input class="form-control" id="monto_cuota_h" type="hidden" name="solicitud[monto_cuota_h]"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="solicitud_Observaciones">Observaciones</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Observaciones" id="idobservacion" name="solicitud[observations]"></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="submit" name="commit" value="Enviar Solicitud" class="btn btn-primary col-md-offset-5 subsolicitud"> </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Prestamos Activos</h3> </div>
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
                        <tr>
                            <td align="right">6857</td>
                            <td> <a href="/users/3046/loans/36857">
                                    Mediano Plazo
</a> </td>
                            <td align="right">23-JUL-2015</td>
                            <td align="right">18.400,00 </td>
                            <td align="right">12.156,63 </td>
                            <td align="right">0,00 </td>
                            <td align="right">7.767,62 </td>
                            <td align="right">0,00 </td>
                        </tr>
                        <tr>
                            <td align="right">4269</td>
                            <td> <a href="/users/3046/loans/34269">
                                    Especial
</a> </td>
                            <td align="right">19-JUL-2013</td>
                            <td align="right">9.100,00 </td>
                            <td align="right">11.694,85 </td>
                            <td align="right">0,00 </td>
                            <td align="right">653,85 </td>
                            <td align="right">0,00 </td>
                        </tr>
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
    <!-- /.row -->
</section>