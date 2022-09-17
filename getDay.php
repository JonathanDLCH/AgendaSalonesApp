<?php
function get_dia($nombredia) {
    /**
     * $nombredía : fecha formato date
     * Nos regresa el día de la semana en string de acuerdo al array
     */
    $dias = array('Dom','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
    $fecha = $dias[date('N', strtotime($nombredia))];
    return $fecha;
}
?>