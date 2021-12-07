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
            $sql  = "select * from usuario WHERE usuario = '$usuario' AND estatus = 1";
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
            if($data){
                if(password_verify($contra,$data[0]['clave'])){
                    return $data;
                }else{
                    return 0;
                }
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
                    p.direccion,
                    u.usuario,
                    u.clave,
                    r.tipoRol,
                    co.entResp,
                    co.id as idEntResp,
                    r.id as idRol,
                    p.id as idPersona
                    FROM
                    usuario AS u
                    INNER JOIN company AS co ON (u.idCompany = co.id)
                    INNER JOIN rol AS r ON (u.idRol = r.id)
                    INNER JOIN persona AS p ON (u.idPersona = p.id)
                    WHERE u.estatus = 1
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

        function registrar_usuario($nombre,$apellido,$cedula,$telefono,$email,$direccion,$usuario,$clave,$tipoRol,$entResp){
            $conn = $this->conexion->conectar();
            $sql  = "BEGIN TRY
                     BEGIN TRAN
                     DECLARE @idPersona int
                     INSERT INTO persona(nombre,apellido,cedula,telefono,email,direccion)
                     VALUES('$nombre','$apellido','$cedula','$telefono','$email','$direccion')
                     SET @idPersona = SCOPE_IDENTITY()
                     INSERT INTO Usuario(idPersona,usuario,clave,idRol,idCompany,estatus) 
                     VALUES(@idPersona,'$usuario','$clave',$tipoRol,$entResp,1)
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

        function modificar_usuario($id,$estatus){
            $conn = $this->conexion->conectar();
            $sql  = "UPDATE usuario set estatus= $estatus
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
        function modificar_datos_usuario($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$usuario,$clave,$tipoRol,$entResp,$idPersona){
            $conn = $this->conexion->conectar();

            if($clave == 'ERROR'){
                $claveValidacion = "";
            }else{
                $claveValidacion = ",clave = '$clave' ";
            }

            $sql  = "BEGIN TRY
                    BEGIN TRAN
                    UPDATE persona SET
                    nombre = '$nombre', 
                    apellido = '$apellido',
                    cedula = $cedula,
                    telefono = '$telefono',
                    email = '$email',
                    direccion = '$direccion'
                    WHERE id= $idPersona

                    UPDATE usuario SET
                    usuario= '$usuario' 
                    $claveValidacion,
                    idRol= $tipoRol,
                    idCompany = $entResp
                    WHERE id=$id

                    COMMIT TRAN
                    END TRY
                    BEGIN CATCH
                    ROLLBACK TRAN
                    END CATCH
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
    

?>