<section class="content invoice">
    <div class="row">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title">Nueva Solicitud</h3> </div>
            <div class="box-body pad">
                <form class="form-horizontal" action="/users/3046/requests" accept-charset="UTF-8" method="post">
                    <input name="utf8" type="hidden" value="✓">
                    <input type="hidden" name="authenticity_token" value="wK82vRUxZUOvNrxdl87KfBt4oqKE8Dcd42Oa7qdDxKneLHW5HdZrmGCeQYjJB33GZClhEKUik+XJNpk7t4Z3SA==">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="solicitud_Tipo de solicitud">Tipo de solicitud</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="requesttype" name="solicitud[request_type]">
                                <option value="Solicitud de Prestamo">Solicitud de Prestamo</option>
                                <option value="Solicitud de Retiro Parcial">Solicitud de Retiro Parcial</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="loantype" style="display: block;">
                        <label class="col-sm-4 control-label" for="solicitud_Tipo de Prestamo">Tipo de prestamo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="loantype" name="solicitud[loantype]">
                                <option value="Corto Plazo">Corto Plazo</option>
                                <option value="Mediano Plazo">Mediano Plazo</option>
                                <option value="Largo Plazo">Largo Plazo</option>
                                <option value="Especial">Especial</option>
                                <option value="Hipotecario">Hipotecario</option>
                                <option value="Mejoramiento Profesional">Mejoramiento Profesional</option>
                                <option value="Asistencia Medica Y Emergencias">Asistencia Medica Y Emergencias</option>
                                <option value="Recreacion, Turismo Y Deporte">Recreacion, Turismo Y Deporte</option>
                                <option value="Polizas De Seguro">Polizas De Seguro</option>
                                <option value="Adquisicion De Vehiculo">Adquisicion De Vehiculo</option>
                                <option value="Asistencia Financiera">Asistencia Financiera</option>
                                <option value="Seguro Funerario">Seguro Funerario</option>
                                <option value="Renovacion De Polizas De Prestamos">Renovacion De Polizas De Prestamos</option>
                                <option value="Hipotecarios Viejos (9,74)">Hipotecarios Viejos (9,74)</option>
                                <option value="Descuentos A Otras Cajas">Descuentos A Otras Cajas</option>
                                <option value="Polizas De Seguro (Empleados)">Polizas De Seguro (Empleados)</option>
                                <option value="Largo Plazo Especial">Largo Plazo Especial</option>
                                <option value="Prestamo Con Fianzas Corto Plazo">Prestamo Con Fianzas Corto Plazo</option>
                                <option value="Prestamo Con Fianzas Mediano Plazo">Prestamo Con Fianzas Mediano Plazo</option>
                                <option value="Largo Plazo Con Fianzas">Largo Plazo Con Fianzas</option>
                                <option value="Recreacion, Turismo Y Deporte">Recreacion, Turismo Y Deporte</option>
                                <option value="Mejoramiento Profesional Con Fianzas">Mejoramiento Profesional Con Fianzas</option>
                                <option value="Largo Plazo Especial Con Fianzas">Largo Plazo Especial Con Fianzas</option>
                                <option value="Especial Con Fianzas">Especial Con Fianzas</option>
                                <option value="Asistencia Medica Y Emergencias Con Fian">Asistencia Medica Y Emergencias Con Fian</option>
                                <option value="Recreacion, Turismo Y Deporte Con Fianza">Recreacion, Turismo Y Deporte Con Fianza</option>
                                <option value="Polizas De Seguro Con Fianzas">Polizas De Seguro Con Fianzas</option>
                                <option value="Parcelas Del Campo Santo">Parcelas Del Campo Santo</option>
                                <option value="Servicio Funerario">Servicio Funerario</option>
                                <option value="Proveeduria">Proveeduria</option>
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