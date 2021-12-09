<?php
    require '../../modelo/modelo_conductor.php';

    $MU = new modelo_conductor();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_conductor($id,$estatus);
    echo $consulta;