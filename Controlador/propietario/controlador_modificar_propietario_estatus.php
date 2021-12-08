<?php
    require '../../modelo/modelo_propietario.php';

    $MU = new modelo_propietario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_propietario($id,$estatus);
    echo $consulta;