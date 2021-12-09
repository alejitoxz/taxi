<?php
    require '../../modelo/modelo_conductor.php';

    $MU = new modelo_conductor();
    $valor = htmlspecialchars($_POST['valor'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->buscar_persona($valor);
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }