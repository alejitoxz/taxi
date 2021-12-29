<?php
    require '../../modelo/modelo_tarjeton.php';

    $MT = new modelo_tarjeton();
    $nombres = htmlspecialchars($_GET['nombres'],ENT_QUOTES,'UTF-8');
    $placa = htmlspecialchars($_GET['placa'],ENT_QUOTES,'UTF-8');
    $nInterno = htmlspecialchars($_GET['nInterno'],ENT_QUOTES,'UTF-8');
    $nMovilizacion = htmlspecialchars($_GET['nMovilizacion'],ENT_QUOTES,'UTF-8');
    $vLicencia = htmlspecialchars($_GET['vLicencia'],ENT_QUOTES,'UTF-8');
    $vMovilizacion = htmlspecialchars($_GET['vMovilizacion'],ENT_QUOTES,'UTF-8');
    $vSoat = htmlspecialchars($_GET['vSoat'],ENT_QUOTES,'UTF-8');
    $eps = htmlspecialchars($_GET['eps'],ENT_QUOTES,'UTF-8');
    $rh = htmlspecialchars($_GET['rh'],ENT_QUOTES,'UTF-8');
    $arl = htmlspecialchars($_GET['arl'],ENT_QUOTES,'UTF-8');
    $fondoPension = htmlspecialchars($_GET['fondoPension'],ENT_QUOTES,'UTF-8');
    $entResp = htmlspecialchars($_GET['entResp'],ENT_QUOTES,'UTF-8');
    $nit = htmlspecialchars($_GET['nit'],ENT_QUOTES,'UTF-8');
    $id = htmlspecialchars($_GET['id'],ENT_QUOTES,'UTF-8');
    $consulta = $MT->exportar($nombres,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id);
