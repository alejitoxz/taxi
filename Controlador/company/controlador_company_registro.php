<?php
    require '../../modelo/modelo_company.php';

    $MU = new modelo_company();
    $entResp = htmlspecialchars($_POST['entResp'],ENT_QUOTES,'UTF-8');
    $nit = htmlspecialchars($_POST['nit'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->registrar_company($entResp,$nit);
    echo $consulta;