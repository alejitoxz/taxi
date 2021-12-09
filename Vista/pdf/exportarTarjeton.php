<?php
    class modelo_tarjeton{
        private $conexion;

        function __construct(){
            require_once '../modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function exportar(){
            $conn = $this->conexion->conectar();
            $this->conexion->conectar();
        }
        
}

?>