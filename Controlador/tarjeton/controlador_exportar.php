<?php
    require '../../modelo/modelo_tarjeton.php';
    require '../../modelo/modelo_tarifa.php';

    $TA = new modelo_tarifa();
    $MT = new modelo_tarjeton();

    $dueno = htmlspecialchars($_GET['dueno'],ENT_QUOTES,'UTF-8');
    $conductor = htmlspecialchars($_GET['conductor'],ENT_QUOTES,'UTF-8');
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
    $control = htmlspecialchars($_GET['control'],ENT_QUOTES,'UTF-8');
    $id = htmlspecialchars($_GET['id'],ENT_QUOTES,'UTF-8');
    $ext = htmlspecialchars($_GET['ext'],ENT_QUOTES,'UTF-8');
    $dir = htmlspecialchars($_GET['dir'],ENT_QUOTES,'UTF-8');
    $tele = htmlspecialchars($_GET['tele'],ENT_QUOTES,'UTF-8');
    $tarifas = $TA->listar_tarifa();
    $consulta = $MT->exportarTarjeton($dueno,$conductor,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id,$tarifas,$control,$ext,$dir,$tele);
