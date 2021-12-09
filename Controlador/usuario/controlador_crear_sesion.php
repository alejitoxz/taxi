<?php

$ID = $_POST['id'];
$USUARIO = $_POST['usuario'];
$ROL = $_POST['rol'];
$COMPANY = $_POST['company'];
$ENTE = $_POST['ente'];

$Datos = $_POST['Datos'];

session_start();
$_SESSION['S_ID']=$ID;
$_SESSION['USUARIO']=$USUARIO;
$_SESSION['ROL']=$ROL;
$_SESSION['COMPANY']=$COMPANY;
$_SESSION['ENTE']=$ENTE;

$_SESSION['Datos']=$Datos;