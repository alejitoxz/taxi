<?php
    require '../../modelo/modelo_company.php';

    $MU = new modelo_company();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $entResp = htmlspecialchars($_POST['entResp'],ENT_QUOTES,'UTF-8');
    $nit = htmlspecialchars($_POST['nit'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->editar_company($id,$entResp,$nit);
    echo $consulta;