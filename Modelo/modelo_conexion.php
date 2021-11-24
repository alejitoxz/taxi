<?php
define("SERVIDOR","74.208.36.204");
define("BD","taxisCompany");
define("USUARIO","sistemasvsat");
define("CLAVE","mfcvelazvsat");
date_default_timezone_set('America/Bogota');

    class conexion{
        public $serverName;
        public $conn;
        public $connectionInfo;

        public function __construct(){
  
        }
        function conectar() {
           $serverName = SERVIDOR;
            $connectionInfo = array("Database" => BD, "UID"=>USUARIO, "PWD"=>CLAVE , "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            if( $conn === false ) {
                echo -1;
                exit;
            }
    
            return $conn;
        }
        function cerrar(){
            $this->conexion->close();
        }
    }