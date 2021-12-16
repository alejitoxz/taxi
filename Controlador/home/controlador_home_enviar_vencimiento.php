<?php
    require '../../modelo/modelo_home.php';
    

    $MU = new modelo_home();

    $Propietario = htmlspecialchars($_POST['Propietario'],ENT_QUOTES,'UTF-8');
    $Conductor = htmlspecialchars($_POST['Conductor'],ENT_QUOTES,'UTF-8');
    $Placa = htmlspecialchars($_POST['Placa'],ENT_QUOTES,'UTF-8');
    $Vencimiento = htmlspecialchars($_POST['Vencimiento'],ENT_QUOTES,'UTF-8');
    $Fecha = htmlspecialchars($_POST['Fecha'],ENT_QUOTES,'UTF-8');
    $Email = htmlspecialchars($_POST['Email'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->enviarVencimiento($Propietario,$Conductor,$Placa,$Vencimiento,$Fecha,$Email); 
    if($consulta){
        return 1;
    }else {
        return 0;
    }
