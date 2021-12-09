<?php
session_start();
    class modelo_conductor{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_conductor(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "SELECT
                    con.id,
                    (p.nombre + ' ' + p.apellido) AS dueno, 
                    p.cedula,
                    p.telefono,
                    p.email,
                    p.direccion,
                    con.eps,
                    con.arl,
                    con.rh,
                    con.fondoPension,
                    CONVERT ( VARCHAR, con.vLicencia ) AS vLicencia,
                    v.placa
                    FROM
                    conductor AS con
                    INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                    INNER JOIN persona AS p ON ( con.idPersona = p.id ) 
                    WHERE con.estatus = 1 and con.idCompany = $idCompany 
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

        function listar_placa(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT id, placa from vehiculo";
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
        function buscar_persona($valor){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
                    *
                    FROM
                    persona 
                    WHERE cedula = $valor
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

        function registrar_conductor($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$eps,$arl,$rh,$fondoPension,$vLicencia,$placa){
            $idCompany = $_SESSION['COMPANY'];
            $cadena = "";
            if($id){
                $cadena = "
                INSERT INTO conductor(idPersona,vLicencia,idVehiculo,estatus,,eps,arl,rh,fondoPension) 
                VALUES($id,'$vLicencia','$placa',1,'$eps','$arl','$rh','$fondoPension')";
            }else{
                
                $cadena = "DECLARE @idPersona int
                INSERT INTO persona(nombre,apellido,cedula,telefono,email,direccion)
                VALUES('$nombre','$apellido','$cedula','$telefono','$email','$direccion')
                SET @idPersona = SCOPE_IDENTITY()
                INSERT INTO conductor(idPersona,vLicencia,idVehiculo,estatus,eps,arl,rh,fondoPension,idCompany) 
                VALUES(@idPersona,'$vLicencia','$placa',1,'$eps','$arl','$rh','$fondoPension',$idCompany)";
            }
            
            $conn = $this->conexion->conectar();
            $sql  = "BEGIN TRY
                     BEGIN TRAN
                     
                     $cadena
                     
                     COMMIT TRAN
                     END TRY
                     BEGIN CATCH
                     ROLLBACK TRAN
                     END CATCH";

            $resp = sqlsrv_query($conn, $sql);

            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }

        function contador_conductor(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "select COUNT(id) as contadorConductor from conductor
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