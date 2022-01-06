<?php
    require '../../modelo/modelo_tarifa.php';

    $MU = new modelo_tarifa();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $concepto = htmlspecialchars($_POST['concepto'],ENT_QUOTES,'UTF-8');
    $tarifa = htmlspecialchars($_POST['tarifa'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->editar_tarifa($id,$concepto,$tarifa);
    echo $consulta;