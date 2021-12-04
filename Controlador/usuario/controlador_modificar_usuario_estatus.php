<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_usuario($id,$estatus);
    echo $consulta;