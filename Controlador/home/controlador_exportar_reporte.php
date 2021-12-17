<?php
    require '../../modelo/modelo_home.php';

    $MU = new modelo_home();
    $listado = $MU->listar_home();
    $pdf = $MU->VencimientoPDF($listado['data']);