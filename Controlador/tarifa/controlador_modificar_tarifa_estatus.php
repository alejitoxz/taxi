<?php
    require '../../modelo/modelo_tarifa.php';

    $MU = new modelo_tarifa();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_tarifa($id,$estatus);
    echo $consulta;