<?php
    require '../../modelo/modelo_vehiculo.php';

    $MU = new modelo_vehiculo();

    $consulta = $MU->listar_pro();
    echo json_encode($consulta);