<?php
    require '../../modelo/modelo_vehiculo.php';

    $MV = new modelo_vehiculo();

    $consulta = $MV->contador_vehiculo();
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }