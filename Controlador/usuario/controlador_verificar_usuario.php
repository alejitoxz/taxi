<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();
    $usuario = htmlspecialchars($_POST['user'],ENT_QUOTES,'UTF-8');
    $contra = htmlspecialchars($_POST['pass'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->VerificarUsuario($usuario,$contra);
    $data = json_encode($consulta);
    if($consulta>0){
        echo $data;
    }else{
        echo 0;
        
    }