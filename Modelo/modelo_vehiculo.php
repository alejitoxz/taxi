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
            CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
            CONVERT(varchar,v.vSoat) as vSoat,
            co.id as idEntResp,
            pro.id as idPropietario
            FROM
            vehiculo AS v
            INNER JOIN company AS co ON (v.idCompañia = co.id)
            INNER JOIN propietario AS pro ON (v.idPropietario = pro.id)
            INNER JOIN persona AS p ON (pro.idPersona = p.id)
            WHERE v.estatus = 1;
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

        
    function listar_ent_vehiculo(){
        $conn = $this->conexion->conectar();
        $sql  = "SELECT id, entResp from company";
        $resp = sqlsrv_query($conn, $sql);
        if( $resp === false) {
            return 0;
        }
        $i = 0;
        $data = [];
        while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
        {
            $data[$i] = $row;
            $i++;
        }
        if($data>0){
            return $data;
        }else{
            return 0;
        }
        
        $this->conexion->conectar();
    }

    function listar_pro(){
        $conn = $this->conexion->conectar();
        $sql  = "SELECT 
        pro.id,
        (p.nombre + ' ' +p.apellido) as dueno
        from 
        propietario as pro
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
            $data[$i] = $row;
            $i++;
        }
        if($data>0){
            return $data;
        }else{
            return 0;
        }
        
        $this->conexion->conectar();
    }
    
    function registrar_vehiculo($placa,$marca,$modelo,$entResp,$idPropietario,$nInterno,$vMovilizacion,$vSoat){
        $conn = $this->conexion->conectar();
        $sql  = "INSERT INTO vehiculo(placa,marca,modelo,idCompañia,idPropietario,nInterno,vMovilizacion,vSoat,estatus)
                 VALUES('$placa','$marca','$modelo','$entResp','$idPropietario','$nInterno','$vMovilizacion','$vSoat',1)
                 ";
               
        $resp = sqlsrv_query($conn, $sql);
        
        if( $resp === false) {
            return 0;
        }else{
            return 1;
        }
        
        $this->conexion->conectar();
    }


    function modificar_vehiculo($id,$estatus){
        $conn = $this->conexion->conectar();
        $sql  = "UPDATE vehiculo set estatus = $estatus
                WHERE id='$id'
                ";
               
        $resp = sqlsrv_query($conn, $sql);
        
        if( $resp === false) {
            return 0;
        }else{
            return 1;
        }
        
        $this->conexion->conectar();
    }

    function editar_vehiculo($id,$placa,$marca,$modelo,$entResp,$idPropietario,$nInterno,$vMovilizacion,$vSoat){
        $conn = $this->conexion->conectar();

        $sql  = "UPDATE vehiculo SET
                placa= '$usuario' 
                marca= '$tipoRol',
                modelo = '$entResp',
                entResp = '$entResp',
                idPropietario = '$idPropietario',
                nInterno = '$nInterno',
                vMovilizacion = '$vMovilizacion',
                vSoat = '$vSoat'
                WHERE id=$id
                ";
                 
        $resp = sqlsrv_query($conn, $sql);
        
        if( $resp === false) {
            return 0;
        }else{
            return 1;
        }
        
        $this->conexion->conectar();
    }



}