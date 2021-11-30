<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT,['cost'=>10]);
    $tipoRol = htmlspecialchars($_POST['tipoRol'],ENT_QUOTES,'UTF-8');
    $entResp = htmlspecialchars($_POST['entResp'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->registrar_usuario($nombre,$apellido,$cedula,$telefono,$email,$usuario,$clave,$tipoRol,$entResp);
    echo $consulta;
