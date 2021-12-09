<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();

    $consulta = $MU->contador_usuario();
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }
