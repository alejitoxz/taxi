<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();
    $valor = htmlspecialchars($_POST['valor'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->buscar_persona($valor);
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo 0;
    }