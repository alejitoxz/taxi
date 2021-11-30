<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();

    $consulta = $MU->listar_rol();
    echo json_encode($consulta);