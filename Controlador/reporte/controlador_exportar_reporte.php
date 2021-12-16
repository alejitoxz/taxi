<?php
    require '../../modelo/modelo_reporte.php';

    $MR = new modelo_reporte();
    $nombres = htmlspecialchars($_GET['nombres'],ENT_QUOTES,'UTF-8');
    $placa = htmlspecialchars($_GET['placa'],ENT_QUOTES,'UTF-8');
    $conductor = htmlspecialchars($_GET['conductor'],ENT_QUOTES,'UTF-8');
    $vLicencia = htmlspecialchars($_GET['vLicencia'],ENT_QUOTES,'UTF-8');
    $vMovilizacion = htmlspecialchars($_GET['vMovilizacion'],ENT_QUOTES,'UTF-8');
    $vSoat = htmlspecialchars($_GET['vSoat'],ENT_QUOTES,'UTF-8');
    $consulta = $MR->reporte($nombres,$placa,$conductor,$vLicencia,$vMovilizacion,$vSoat);