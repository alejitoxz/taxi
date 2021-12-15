<?php
session_start();
    class modelo_home{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }
        
        function listar_home(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "SELECT
            con.id,
            (prop.nombre + ' ' + prop.apellido) AS propietario,
            v.placa,
            (p.nombre + ' ' + p.apellido) AS conductor,
            p.cedula,
            p.telefono,
            p.email,
            CONVERT(varchar,con.vLicencia) as vLicencia,   
            CONVERT(varchar,v.vSoat) as vSoat,
            CONVERT(varchar,v.vMovilizacion) as vMovilizacion 
            FROM
            conductor AS con
            INNER JOIN persona AS p ON ( con.idPersona = p.id ) 
            INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id ) 
            INNER JOIN company AS c ON ( c.id = con.idCompany ) 
            INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario) 
            INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
            WHERE
            pro.estatus = 1
            and c.id = $idCompany
            ";
            //echo $sql;exit;
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