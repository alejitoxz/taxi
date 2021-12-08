<?php
    class modelo_conductor{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_conductor(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
                    con.id,
                    (p.nombre + ' ' + p.apellido) AS dueno, 
                    p.cedula,
                    p.telefono,
                    p.email,
                    p.direccion,
                    p.eps,
                    p.arl,
                    p.rh,
                    p.fondoPension,
                    CONVERT ( VARCHAR, con.vLicencia ) AS vLicencia,
                    v.placa
                    
                    FROM
                    conductor AS con
                    INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                    INNER JOIN persona AS p ON ( con.idPersona = p.id ) 
                    WHERE
                    con.estatus = 1
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
        }

}