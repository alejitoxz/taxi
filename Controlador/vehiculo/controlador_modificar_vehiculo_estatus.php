<?php
    require '../../modelo/modelo_vehiculo.php';

    $MU = new modelo_vehiculo();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_vehiculo($id,$estatus);
    echo $consulta;