<?php

class Notificaciones {
    public function cola($cedula) {
        $consulsol = paraTodos::arrayConsulta("ID, TP_PREST", "solict_prest", "CEDULA='$cedula' and ESTATUS<>'APROBADO' and ESTATUS<>'ELIMINADO'");
        foreach ($consulsol as $row){
            $consulpersonas = paraTodos::arrayConsultanum("*", "solict_prest", "TP_PREST=$row[TP_PREST] and ID<$row[ID] and ESTATUS<>'APROBADO' and ESTATUS<>'ELIMINADO'");
            $datoscredito = paraTodos::arrayConsulta("*", "tp_prest", "ID=$row[TP_PREST]");
            foreach($datoscredito as $rowdatosc){
                $credito = $rowdatosc[NAME];
            }
?>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-users text-red"></i>Su puesto en la cola para el credito <?php echo $credito; ?> es  el Nº <?php echo $consulpersonas; ?>
                    </a>
                </li>
<?php
        }
    }
}
?>