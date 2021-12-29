<?php
session_start();
    class modelo_propietario{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_propietario(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            if ($Rol == 2) {
                $wr = "and pro.idUsuario = $idUsuario";
                $com = "and c.id = $idCompany";
            }else if ($Rol == 1) {
                $com = "";
                $wr = "";
            }else{ 
                $wr = "";
                $com = "and c.id = $idCompany";
            }
            $sql  = "SELECT
            pro.id,
            p.nombre,
            p.apellido,
            p.cedula,
            p.telefono,
            p.email,
            p.direccion,
            p.id as idPersona
            FROM
            propietario AS pro
            INNER JOIN persona AS p ON ( pro.idPersona = p.id ) 
            INNER JOIN company AS c ON ( c.id = pro.idCompany ) 
            WHERE
            pro.estatus = 1
            $com $wr
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


        function buscar_personaP($valor){
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

        //revisar el tema del alert, no funciona bien
        function registrar_propietario($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion){
            $idCompany = $_SESSION['COMPANY'];
            $idUsuario = $_SESSION['S_ID'];
            $cadena = "";
            if($id){
                $cadena = "
                INSERT INTO propietario(id,estatus,idCompany,idUsuario) 
                VALUES($id,1,$idCompany,$idUsuario)";
            }else{
                
                $cadena = "DECLARE @idPersona int
                INSERT INTO persona(nombre,apellido,cedula,telefono,email,direccion)
                VALUES('$nombre','$apellido','$cedula','$telefono','$email','$direccion')
                SET @idPersona = SCOPE_IDENTITY()
                INSERT INTO propietario(idPersona,estatus,idCompany,idUsuario) 
                VALUES(@idPersona,1,$idCompany,$idUsuario)";
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

        function modificar_propietario($id,$estatus){
            $conn = $this->conexion->conectar();
            $sql  = "UPDATE propietario set estatus= $estatus
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


        function modificar_datos_propietario($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$idPersona){
            $conn = $this->conexion->conectar();

            $sql  = "UPDATE persona SET
                    nombre = '$nombre', 
                    apellido = '$apellido',
                    cedula = $cedula,
                    telefono = '$telefono',
                    email = '$email',
                    direccion = '$direccion'
                    WHERE id = $idPersona
                    ";
            $resp = sqlsrv_query($conn, $sql);
            
            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }

        function contador_propietario(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            if ($Rol == 2) {
                $wr = "idUsuario = $idUsuario";
                $com = "AND idCompany = $idCompany";
            }else if ($Rol == 1) {
                $com = "";
                $wr = "";
            }else{
                $com = "AND idCompany = $idCompany";
                $wr = "";
            }
            $sql  = "SELECT COUNT(id) as contadorPropietario from propietario
            where estatus = 1 $wr $com ";
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