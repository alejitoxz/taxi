<?php
    require '../../modelo/modelo_propietario.php';

    $MP = new modelo_propietario();

    $consulta = $MP->contador_propietario();
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }