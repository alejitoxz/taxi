<?php
    class modelo_usuario{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function VerificarUsuario($usuario,$contra){
            $conn = $this->conexion->conectar();
            $sql  = "select * from usuario WHERE usuario = '$usuario' and clave = '$contra' ";
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
        function listar_usuario(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
                    u.id,
                    p.nombre,
                    p.apellido,
                    p.cedula,
                    p.telefono,
                    p.email,
                    u.usuario,
                    u.clave,
                    r.tipoRol,
                    co.entResp
                    FROM
                    usuario AS u
                    INNER JOIN company AS co ON (u.idCompany = co.id)
                    INNER JOIN rol AS r ON (u.idRol = r.id)
                    INNER JOIN persona AS p ON (u.idPersona = p.id)
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

        function listar_rol(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT id, tipoRol from rol";
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
    
        function listar_ent(){
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

        function registrar_usuario($nombre,$apellido,$cedula,$telefono,$email,$usuario,$clave,$tipoRol,$entResp){
            $conn = $this->conexion->conectar();
            $sql  = "BEGIN TRY
                     BEGIN TRAN
                     DECLARE @idPersona int
                     INSERT INTO persona(nombre,apellido,cedula,telefono,email)
                     VALUES('$nombre','$apellido','$cedula','$telefono','$email')
                     SET @idPersona = SCOPE_IDENTITY()
                     INSERT INTO Usuario(idPersona,usuario,clave,idRol,idCompany)
                     VALUES(@idPersona,'$usuario','$clave',$tipoRol,$entResp)
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


    }
    
?>