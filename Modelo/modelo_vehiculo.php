<?php
    class modelo_vehiculo{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_vehiculo(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
            v.id,
            v.placa,
            v.marca,
            v.modelo,
            co.entResp,
            p.nombre,
            p.apellido,
            v.nInterno,
            v.vMovilizacion,
            v.vSoat
            FROM
            vehiculo AS v
            INNER JOIN company AS co ON (v.idCompañia = co.id)
            INNER JOIN propietario AS pro ON (v.idPropietario = pro.id)
            INNER JOIN persona AS p ON (pro.idPersona = p.id)
            ";

            $resp = sqlsrv_query($conn, $sql);
            if( $resp === false) {
                return 0;
            }
            $i = 0;
            $data = [];
            while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
            {
                $data['data'][] = $row;
                $i++;
            }
            if($data>0){
                return $data;
            }else{
                return 0;
            }
            
            $this->conexion->conectar();
            echo sql;
        }


    }
