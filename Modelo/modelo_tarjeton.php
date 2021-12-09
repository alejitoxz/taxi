<?php
session_start();
    class modelo_tarjeton{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function exportar($nombres){
            $conn = $this->conexion->conectar();
            $this->conexion->conectar();
           
        } 
    }