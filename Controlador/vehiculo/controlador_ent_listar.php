<?php
    require '../../modelo/modelo_vehiculo.php';

    $MU = new modelo_vehiculo();

    $consulta = $MU->listar_ent_vehiculo();
    echo json_encode($consulta);