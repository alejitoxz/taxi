<?php

use PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;
session_start();
    class modelo_home{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            
            require  'PHPMailer/Exception.php';
            require  'PHPMailer/PHPMailer.php';
            require  'PHPMailer/SMTP.php';
            $this->mail = new PHPMailer();
        }
        function listar_home(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "DECLARE @Fecha DATE = DATEADD( DAY, 15, CONVERT ( DATE, GETDATE( ), 1 ) ), @fechaActual DATE = GETDATE( ) 
            SELECT
            * 
            FROM
                (
                SELECT
                    con.id,
                    ( p.nombre + ' ' + p.apellido ) AS conductor,
                    ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                    p.cedula,
                    p.telefono,
                    p.email,
                    v.placa,
                    CONVERT(varchar,con.vLicencia) as vLicencia,
                    CONVERT(varchar,v.vSoat) as vSoat,
                    CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                    @Fecha AS FechaActual,
                CASE
                        
                        WHEN con.vLicencia BETWEEN @fechaActual 
                        AND @Fecha THEN
                            'Licencia' 
                            END AS Vencimiento 
                    FROM
                        conductor AS con
                        INNER JOIN persona AS p ON ( con.idPersona = p.id )
                        INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                        INNER JOIN company AS c ON ( c.id = con.idCompany )
                        INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                        INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                    WHERE
                        pro.estatus = 1 
                        AND c.id = $idCompany 
                    UNION
                    SELECT
                        con.id,
                        ( p.nombre + ' ' + p.apellido ) AS conductor,
                        ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                        p.cedula,
                        p.telefono,
                        p.email,
                        v.placa,
                        CONVERT(varchar,con.vLicencia) as vLicencia,
                        CONVERT(varchar,v.vSoat) as vSoat,
                        CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                        @Fecha AS FechaActual,
                    CASE
                            
                            WHEN v.vMovilizacion BETWEEN @fechaActual 
                            AND @Fecha THEN
                                'Movilizacion' 
                                END AS Vencimiento 
                        FROM
                            conductor AS con
                            INNER JOIN persona AS p ON ( con.idPersona = p.id )
                            INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                            INNER JOIN company AS c ON ( c.id = con.idCompany )
                            INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                            INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                        WHERE
                            pro.estatus = 1 
                            AND c.id = $idCompany 
                        UNION
                        SELECT
                            con.id,
                            ( p.nombre + ' ' + p.apellido ) AS conductor,
                            ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                            p.cedula,
                            p.telefono,
                            p.email,
                            v.placa,
                            CONVERT(varchar,con.vLicencia) as vLicencia,
                            CONVERT(varchar,v.vSoat) as vSoat,
                            CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                            @Fecha AS FechaActual,
                        CASE
                                
                                WHEN v.vSoat BETWEEN @fechaActual 
                                AND @Fecha THEN
                                    'Soat' 
                                    END AS Vencimiento 
                            FROM
                                conductor AS con
                                INNER JOIN persona AS p ON ( con.idPersona = p.id )
                                INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                                INNER JOIN company AS c ON ( c.id = con.idCompany )
                                INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                                INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                            WHERE
                                pro.estatus = 1 
                                AND c.id = $idCompany 
                            ) tablas 
                    WHERE 
                Vencimiento IS NOT NULL
            ";
            $resp = sqlsrv_query($conn, $sql);
            if( $resp === false) {
                return 0;
            }
            $i = 0;
            $Fecha = [];
            $data = [];
            while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
            {
                $data['data'][$i] = $row;
                $Vencimiento = $data['data'][$i]['Vencimiento'];
                $Soat = $data['data'][$i]['vSoat'];
                $Movilizacion = $data['data'][$i]['vMovilizacion'];
                $Licencia = $data['data'][$i]['vLicencia'];

                if($Vencimiento == 'Licencia'){
                    $data['data'][$i]['Fecha'] = $Licencia;
                }else if($Vencimiento == 'Movilizacion'){
                    $data['data'][$i]['Fecha'] = $Movilizacion;
                }elseif ($Vencimiento == 'Soat') {
                    $data['data'][$i]['Fecha'] = $Soat;
                }
                $i++;
            }

            
            
            if($data>0){
                return $data;
            }else{
                return 0;
            }
            
            $this->conexion->conectar();
           
        }

        function enviarVencimiento($Propietario,$Conductor,$Placa,$Vencimiento,$Fecha,$Email){
            
            //echo $Email;
            try {
            $cuerpoMail = utf8_decode("
            <b><h4><center>ALCALDÍA DE IBAGUÉ</center></h4><b>
            <center><img width='150' height='150' src='https://www.visualsatco.com/visualsat.sutc/Vista/imagenes/logo-alcaldia.png'>
            <img width='130' height='150' src='https://www.visualsatco.com/visualsat.sutc/Vista/imagenes/musical.png'></center>
            <b><h4><center>Hola $Conductor, te saluda el SUTC, SISTEMA UNICO DE TARJETONES DE COLOMBIA</center></h4><b>
            <b><h4><center>Le indicamos que su vehículo de placa $Placa, esta próximo a su vencimiento :</center></h4><b>
            <b><h4><center>$Vencimiento  $Fecha</center></h4><b>
            <h4><center>Por favor, debe estar al día</center></h4>
            
                ");	 
            $this->mail->IsSMTP();
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = "ssl";
            $this->mail->Host = "smtp.gmail.com";
            $this->mail->Port = 465;
            $this->mail->Username = "pruebahost19@gmail.com";
            $this->mail->Password = "123456789-a";									
            $this->mail->setFrom( 'pruebahost19@gmail.com'  );
            $this->mail->addAddress ( $Email );									
            $this->mail->Subject='SUTC';
            $this->mail->From ="pruebahost19@gmail.com";
            $this->mail->FromName = "SUTC"; 
            $this->mail->MsgHTML($cuerpoMail);
            $this->mail->IsHTML(true);
            $this->mail->Send();
            echo 1 ;
            }catch( Exception  $e ) {
            echo 0 ;
            }

        }

}