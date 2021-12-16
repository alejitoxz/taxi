<?php
session_start();
    class modelo_tarjeton{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }
    
        function reporte($nombres,$placa,$conductor,$vLicencia,$vMovilizacion,$vSoat){
            $conn = $this->conexion->conectar();
            require('../../vista/plugins/fpdf/fpdf.php');
        }





}