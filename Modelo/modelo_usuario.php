<?php
session_start();
    class modelo_usuario{
        private $conexion;
        public $data;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function VerificarUsuario($usuario,$contra){
            $conn = $this->conexion->conectar();
            $sql1  = "SELECT
                    u.*,
                    m.descripcion,
                    m.url,
                    m.nivel,
                    m.icon,
                    m.idPadre,
                    m.id as idMenu
                    FROM
                    usuario as u
                    INNER JOIN rol as r ON (r.id = u.idRol) 
                    LEFT JOIN rol_modulos as rm ON (rm.idRol = r.id)
                    LEFT JOIN modulos as m ON (m.id = rm.idModulos)  
                    WHERE usuario = '$usuario' AND estatus = 1 
                    and m.nivel = 2 
                    ORDER BY m.orden";
            $resp1 = sqlsrv_query($conn, $sql1);
           
            if( $resp1 === false) {
                return 0;
            }
			$i = 0;
            $data1 = [];
            $data = [];
			while($row1 = sqlsrv_fetch_array( $resp1, SQLSRV_FETCH_ASSOC))
			{
				$data1[$i] = $row1;
				$i++;
			}

            // prueba
            $sql2  = "SELECT
                    *
                    FROM
                    modulos
                    where nivel = 1
                    ORDER BY orden";
            $resp2 = sqlsrv_query($conn, $sql2);
           
            if( $resp2 === false) {
                return 0;
            }
			$k = 0;
            $data2 = [];
			while($row2 = sqlsrv_fetch_array( $resp2, SQLSRV_FETCH_ASSOC))
			{
				$data2[$k] = $row2;
				$k++;
			}



            for($x=0; $x<count($data2);$x++){
                $arrayData      = [];
                $arrayDatax     = [];
                $modulos     = [];

                for($i=0;$i<count($data1);$i++){
                    $validate = 1;
                    
                    if(intval($data2[$x]["id"]) === intval($data1[$i]["idPadre"])){
                        $modulos = $data1[$i];
                        
                        $validate = 2; 
                    }
                    $StatusField = $data2[$x]["descripcion"];
                    if($validate == 2){
                        array_push($arrayDatax,$modulos);
                    }
                }
                
                
                    
                $arrayData = ["modulos"=>$StatusField,"submodulos"=>$arrayDatax];
                array_push($data,$arrayData);

            }

            if($data){
                if(password_verify($contra,$data1[0]['clave'])){
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
            $idCompany = $_SESSION['COMPANY'];
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
                    WHERE u.estatus = 1 and u.idCompany = $idCompany
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

        function contador_usuario(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "select COUNT(id) as contadorUsuario from usuario
            where estatus = 1 AND idCompany = $idCompany";
           
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

        function registrar_usuario($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$usuario,$clave,$tipoRol){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $cadena = "";
            if($id){
                $cadena = "
                INSERT INTO Usuario(idPersona,usuario,clave,idRol,idCompany,estatus) 
                VALUES($id,'$usuario','$clave',$tipoRol,$idCompany,1)";
            }else{
                
                $cadena = "DECLARE @idPersona int
                INSERT INTO persona(nombre,apellido,cedula,telefono,email,direccion)
                VALUES('$nombre','$apellido','$cedula','$telefono','$email','$direccion')
                SET @idPersona = SCOPE_IDENTITY()
                INSERT INTO Usuario(idPersona,usuario,clave,idRol,idCompany,estatus) 
                VALUES(@idPersona,'$usuario','$clave',$tipoRol,$idCompany,1)";
            }
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
        function modificar_datos_usuario($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$usuario,$clave,$tipoRol,$idPersona){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
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
                    idCompany = $idCompany
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