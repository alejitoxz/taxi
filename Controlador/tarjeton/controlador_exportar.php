<?php
    require '../../modelo/modelo_tarjeton.php';

    $MT = new modelo_tarjeton();
    $nombres = htmlspecialchars($_GET['nombres'],ENT_QUOTES,'UTF-8');
    $consulta = $MT->exportar($nombres);
