<?php
session_start();
    class modelo_vehiculo{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_vehiculo(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            if ($Rol == 2) {
                $wr = "and pro.idUsuario = $idUsuario";
            }else{
                $wr = "";
            }
            

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
            v.nMovilizacion,
            co.id as idEntResp,
            pro.id as idPropietario
            FROM
            vehiculo AS v
            INNER JOIN company AS co ON (v.idCompany = co.id)
            INNER JOIN propietario AS pro ON (v.idPropietario = pro.id)
            INNER JOIN persona AS p ON (pro.idPersona = p.id)
            WHERE v.estatus = 1 and v.idCompany = $idCompany $wr;
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


    function listar_pro(){
        $conn = $this->conexion->conectar();
        $idCompany = $_SESSION['COMPANY'];
        $Rol = $_SESSION['ROL'];
        $idUsuario = $_SESSION['S_ID'];

        if ($Rol == 2) {
            $wr = "and pro.idUsuario = $idUsuario";
        }else{
            $wr = "";
        }
        $sql  = "SELECT 
        pro.id,
        (p.nombre + ' ' +p.apellido) as dueno
        from 
        propietario as pro
        INNER JOIN persona AS p ON (pro.idPersona = p.id)
        where pro.idCompany = $idCompany and pro.estatus = 1 $wr
        ";
        //echo $sql;
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
    
    function registrar_vehiculo($placa,$marca,$modelo,$idPropietario,$nInterno,$vMovilizacion,$vSoat,$nMovilizacion){
        $conn = $this->conexion->conectar();
        $idCompany = $_SESSION['COMPANY'];
        $idUsuario = $_SESSION['S_ID'];

        $sql  = "INSERT INTO vehiculo(placa,marca,modelo,idCompany,idPropietario,nInterno,vMovilizacion,vSoat,estatus,nMovilizacion,idUsuario)
                 VALUES('$placa','$marca','$modelo',$idCompany,'$idPropietario','$nInterno','$vMovilizacion','$vSoat',1,'$nMovilizacion',$idUsuario)
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

    function editar_vehiculo($id,$placa,$marca,$modelo,$idPropietario,$nInterno,$vMovilizacion,$vSoat,$nMovilizacion){
        $conn = $this->conexion->conectar();

        $sql  = "UPDATE vehiculo SET
                placa= '$placa', 
                marca= '$marca',
                modelo = '$modelo',
                idPropietario = '$idPropietario',
                nInterno = '$nInterno',
                vMovilizacion = '$vMovilizacion',
                vSoat = '$vSoat',
                nMovilizacion = '$nMovilizacion'
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

    function contador_vehiculo(){
        $conn = $this->conexion->conectar();
        $idCompany = $_SESSION['COMPANY'];
        $sql  = "select COUNT(id) as contadorVehiculo from vehiculo
        where estatus = 1 AND idCompany = $idCompany";
       //echo $sql;
        $resp = sqlsrv_query($conn, $sql);
        if( $resp === false) {
            return 0;
        }
        $i = 0;
        
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


}