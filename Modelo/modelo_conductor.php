<?php
session_start();
    class modelo_conductor{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            require  'phpqrcode/qrlib.php';
            $this->conexion = new conexion();
        }

        function listar_conductor(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            // admin ve todo
            if ($Rol == 1) {
                $wr = "";
                $com = "";
            }
            // compañia ve todo de su compañia
            else if ($Rol == 4) {
                $com = "AND con.idCompany = $idCompany";
                $wr = "";
            }
            // independiente ve solo lo de su usuario
            else if ($Rol == 3) {
                $com = "AND con.idCompany = $idCompany";
                $wr = "AND con.idUsuario = $idUsuario";
            }

            
            $sql  = "SELECT
            con.id,
            p.id AS idPersonaC,
            p.nombre,
            p.apellido,
            ( p.nombre + ' ' + p.apellido ) AS conductor,
            ( propp.nombre + ' ' + propp.apellido ) AS dueno,
            p.cedula,
            propp.cedula AS cedulap,
            p.telefono,
            p.email,
            p.direccion,
            con.eps,
            CONVERT ( VARCHAR, con.vSeguridad ) AS vSeguridad,
            con.arl,
            con.rh,
            con.fondoPension,
            con.codigo_bar,
            con.url_foto,
            CONVERT ( VARCHAR, con.vLicencia ) AS vLicencia,
            CONVERT ( VARCHAR, v.vSoat ) AS vSoat,
            CONVERT ( VARCHAR, v.vMovilizacion ) AS vMovilizacion,
            CONVERT ( VARCHAR, v.vTecnomecanica ) AS vTecnomecanica,
            v.nMovilizacion,
            v.placa,
            v.nInterno,
            v.id AS idVehiculo,
            c.entResp,
            c.nit 
        FROM
            conductor AS con
            INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
            INNER JOIN persona AS p ON ( con.idPersona = p.id )
            INNER JOIN propietario AS prop ON ( v.idPropietario = prop.id )
            INNER JOIN persona AS propp ON ( prop.idPersona = propp.id )
            INNER JOIN company AS c ON ( c.id = con.idCompany ) 
            WHERE con.estatus = 1 $com $wr order by con.id asc
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
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            // admin ve todo
            if ($Rol == 1) {
                $wr = "";
                $com = "";
            }
            // compañia ve todo de su compañia
            else if ($Rol == 4) {
                $com = "AND c.id = $idCompany";
                $wr = "";
            }
            // independiente ve solo lo de su usuario
            else if ($Rol == 3) {
                $com = "AND c.id = $idCompany";
                $wr = "AND v.idUsuario = $idUsuario";
            }

            

            $sql  = "SELECT v.id, v.placa 
            from vehiculo as v
            INNER JOIN company AS c ON ( c.id = v.idCompany ) 
            where v.estatus = 1 $com $wr";
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
                    WHERE cedula = '$valor'
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

        function registrar_conductor($id,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$eps,$arl,$rh,$fondoPension,$vLicencia,$placa,$vSeguridad,$ext,$imagen){
            $idCompany = $_SESSION['COMPANY'];
            $idUsuario = $_SESSION['S_ID'];
            $cadena = "";
            $codigo_bar = rand();

            if($ext){
                $url = $ext;
            }else{
                $url = "";
            }

            if($id){
                $cadena = "
                INSERT INTO conductor(idPersona,vLicencia,idVehiculo,estatus,eps,arl,rh,fondoPension,idCompany,vSeguridad,idUsuario,codigo_bar,url_foto) 
                VALUES($id,'$vLicencia','$placa',1,'$eps','$arl','$rh','$fondoPension',$idCompany,'$vSeguridad',$idUsuario,'$codigo_bar','$url')";
            }else{
                
                

                $cadena = "DECLARE @idPersona int
                INSERT INTO persona(nombre,apellido,cedula,telefono,email,direccion)
                VALUES('$nombre','$apellido','$cedula','$telefono','$email','$direccion')
                SET @idPersona = SCOPE_IDENTITY()
                INSERT INTO conductor(idPersona,vLicencia,idVehiculo,estatus,eps,arl,rh,fondoPension,idCompany,vSeguridad,idUsuario,codigo_bar,url_foto) 
                VALUES(@idPersona,'$vLicencia','$placa',1,'$eps','$arl','$rh','$fondoPension',$idCompany,'$vSeguridad',$idUsuario,'$codigo_bar','$url')";
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
                     //echo $sql;exit;
            $resp = sqlsrv_query($conn, $sql);            
            $dir = "../../Vista/imagenes/foto/";
            // consulta
            if( $resp === false) {
                return 0;
            }else{

                if($imagen){
                    $sql  = "SELECT MAX(id) as id from conductor";
                    $resp = sqlsrv_query($conn, $sql);
                    $i = 0;
                    while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
                    {
                        $data[$i] = $row;
                        $i++;
                    }
    
                    $idF = $data[0]['id'];
                
                    if(!file_exists($dir)){
                        mkdir($dir);
                    }

                    $url =  $dir."foto-".$idF.".".$ext;
                    move_uploaded_file($imagen,$url);
                }
                return 1;
            }
            
            $this->conexion->conectar();
        }

   

        function generarqr($id){
            $dir = "../../Vista/imagenes/qr/";
            // consulta
            if($id){
                $idF = $id;
            }else{
                $conn = $this->conexion->conectar();
                $sql  = "SELECT MAX(id) as id from conductor";
                $resp = sqlsrv_query($conn, $sql);
                $i = 0;
                while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
                {
                    $data[$i] = $row;
                    $i++;
                }

                $idF = $data[0]['id'];
            }
            if(!file_exists($dir)){
                mkdir($dir);
            }
            $filename = $dir."qr-".$idF.".png";
            //echo "<img src='$filename'> ";
            $tamano = 10;
            $level = "M";
            $frameSize = 3;
            $contenido = "https://www.visualsatco.com/visualsat.sutc/qr.php?conductor=".$idF;

            QRcode::png($contenido,$filename,$level,$tamano,$frameSize);

        
        }

        function contador_conductor(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            // admin ve todo
            if ($Rol == 1) {
                $wr = "";
                $com = "";
            }
            // compañia ve todo de su compañia
            else if ($Rol == 4) {
                $com = "AND idCompany = $idCompany";
                $wr = "";
            }
            // independiente ve solo lo de su usuario
            else if ($Rol == 3) {
                $com = "AND idCompany = $idCompany";
                $wr = "AND idUsuario = $idUsuario";
            }

            
            $sql  = "SELECT COUNT(id) as contadorConductor from conductor
            where estatus = 1 $wr $com";
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

        function modificar_conductor($id,$estatus){
            $conn = $this->conexion->conectar();
            $sql  = "UPDATE conductor set estatus= $estatus
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
    
        function modificar_datos_conductor($id,$idPersonaC,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$idVehiculo,$eps,$arl,$rh,$fondoPension,$vLicencia,$vSeguridad,$ext,$imagen){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $codigo_bar = rand();
  

            if($ext){
                $url = ",url_foto = '$ext'";
            }else{
                $url = "";
            }

            $sql  = "BEGIN TRY
                    BEGIN TRAN
                    UPDATE persona SET
                    nombre = '$nombre', 
                    apellido = '$apellido',
                    cedula = '$cedula',
                    telefono = '$telefono',
                    email = '$email',
                    direccion = '$direccion'
                    WHERE id= $idPersonaC

                    UPDATE conductor SET
                    vLicencia='$vLicencia',
                    idVehiculo='$idVehiculo',
                    eps= '$eps',
                    arl= '$arl',
                    rh = '$rh',
                    fondoPension = '$fondoPension',
                    idCompany = $idCompany,
                    vSeguridad= '$vSeguridad',
                    codigo_bar = '$codigo_bar'
                    $url
                    WHERE id=$id

                    
                    COMMIT TRAN
                    END TRY
                    BEGIN CATCH
                    ROLLBACK TRAN
                    END CATCH
                    ";
                    
            $resp = sqlsrv_query($conn, $sql);
            $dir = "../../Vista/imagenes/foto/";
            // consulta
            if( $resp === false) {
                return 0;
            }else{
                if($imagen){
                   // var_dump($imagen);
                    if(!file_exists($dir)){
                        mkdir($dir);
                    }
    
                    $url =  $dir."foto-".$id.".".$ext;
                    move_uploaded_file($imagen,$url);
                }                
                
                return 1;
            }
            
            $this->conexion->conectar();
        }


        function listar_vencimientos(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "SELECT 
            con.id,
            (p.nombre + ' ' +p.apellido) as dueno
            from 
            conductor as con
            INNER JOIN persona AS p ON (con.idPersona = p.id)
            where con.idCompany = $idCompany and con.estatus = 1
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



}




