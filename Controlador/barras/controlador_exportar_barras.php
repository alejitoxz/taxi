<?php
    require '../../modelo/modelo_barras.php';

    $MT = new modelo_barras();

    $vSeguridad = htmlspecialchars($_GET['vSeguridad'],ENT_QUOTES,'UTF-8');
    $fechaActual = htmlspecialchars($_GET['fechaActual'],ENT_QUOTES,'UTF-8');
    $codigo_bar = htmlspecialchars($_GET['codigo_bar'],ENT_QUOTES,'UTF-8');
    $consulta = $MT->exportarbarras($vSeguridad,$fechaActual,$codigo_bar);