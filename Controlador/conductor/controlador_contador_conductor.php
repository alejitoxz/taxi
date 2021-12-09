<?php
    require '../../modelo/modelo_conductor.php';

    $MC = new modelo_conductor();

    $consulta = $MC->contador_conductor();
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }