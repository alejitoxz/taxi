<?php

$ID = $_POST['id'];
$USUARIO = $_POST['usuario'];
$ROL = $_POST['rol'];
session_start();
$_SESSION['S_ID']=$ID;
$_SESSION['USUARIO']=$USUARIO;
$_SESSION['ROL']=$ROL;

