<?php
    require '../../modelo/modelo_conductor.php';
    $MU = new modelo_conductor();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $idVehiculo = htmlspecialchars($_POST['idVehiculo'],ENT_QUOTES,'UTF-8');
    $eps = htmlspecialchars($_POST['eps'],ENT_QUOTES,'UTF-8');
    $arl = htmlspecialchars($_POST['arl'],ENT_QUOTES,'UTF-8');
    $rh = htmlspecialchars($_POST['rh'],ENT_QUOTES,'UTF-8');
    $fondoPension = htmlspecialchars($_POST['fondoPension'],ENT_QUOTES,'UTF-8');
    $vLicencia = htmlspecialchars($_POST['vLicencia'],ENT_QUOTES,'UTF-8');
    $idPersonaC = htmlspecialchars($_POST['idPersonaC'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->modificar_datos_conductor($id,$idPersonaC,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$idVehiculo,$eps,$arl,$rh,$fondoPension,$vLicencia);
    echo $consulta;