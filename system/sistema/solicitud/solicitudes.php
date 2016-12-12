<link href="<?php echo $ruta_base;?>assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<div class="box box-solid box-warning">
    <div class="box-header">
        <h3 class="box-title">Solicitudes Realizadas</h3> </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <table id="solicitudes" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 202px;">Nº</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 299px;">Fecha</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 267px;">Tipo</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 172px;">Monto</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 122px;">Cancelar</th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<script type="text/javascript">
    $(function() {
        $('#solicitudes').dataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }            
        });
    });
</script>