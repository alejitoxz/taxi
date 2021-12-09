<?php
    require '../../modelo/modelo_vehiculo.php';

    $MU = new modelo_vehiculo();
    $placa = htmlspecialchars($_POST['placa'],ENT_QUOTES,'UTF-8');
    $marca = htmlspecialchars($_POST['marca'],ENT_QUOTES,'UTF-8');
    $modelo = htmlspecialchars($_POST['modelo'],ENT_QUOTES,'UTF-8');
    $idPropietario = htmlspecialchars($_POST['idPropietario'],ENT_QUOTES,'UTF-8');
    $nInterno = htmlspecialchars($_POST['nInterno'],ENT_QUOTES,'UTF-8');
    $vMovilizacion = htmlspecialchars($_POST['vMovilizacion'],ENT_QUOTES,'UTF-8');
    $vSoat = htmlspecialchars($_POST['vSoat'],ENT_QUOTES,'UTF-8');
    $nMovilizacion = htmlspecialchars($_POST['nMovilizacion'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->registrar_vehiculo($placa,$marca,$modelo,$idPropietario,$nInterno,$vMovilizacion,$vSoat,$nMovilizacion);
    echo $consulta;