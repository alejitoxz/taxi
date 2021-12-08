<?php
    require '../../modelo/modelo_propietario.php';

    $MU = new modelo_propietario();
    $valor = htmlspecialchars($_POST['valor'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->buscar_personaP($valor);
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }