<?php
    require '../../modelo/modelo_tarifa.php';

    $MU = new modelo_tarifa();
    $concepto = htmlspecialchars($_POST['concepto'],ENT_QUOTES,'UTF-8');
    $tarifa = htmlspecialchars($_POST['tarifa'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->registrar_tarifa($concepto,$tarifa);
    echo $consulta;