<?php
    require '../../modelo/modelo_company.php';

    $MU = new modelo_company();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_company($id,$estatus);
    echo $consulta;