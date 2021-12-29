<?php
    require '../../modelo/modelo_conductor.php';

    $MU = new modelo_conductor();

    $consulta = $MU->listar_vencimientos();
    echo json_encode($consulta);