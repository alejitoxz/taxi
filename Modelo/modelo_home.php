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
            $Rol = $_SESSION['ROL'];
            $idUsuario = $_SESSION['S_ID'];

            if ($Rol == 2) {
                $wr = "and pro.idUsuario = $idUsuario";
            }else if ($Rol == 1) {
                $com = "";
                $wr = "";
            }else{
                $wr = "";
                $com = "AND c.id = $idCompany ";
            }
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
                        $com
                        $wr
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
                            $com
                            $wr
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
                                $com
                                $wr
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

        function VencimientoPDF($datos){
            $conn = $this->conexion->conectar();
            $date = date('Y-m-d');
            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            
            //cabecera
            $pdf->SetFont('Arial','B',12);
            $pdf->Image('../../vista/imagenes/logo-alcaldia.png' , 18 ,6, 0 , 30,'png');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(200,10,'ALCALDIA DE IBAGUE',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(200,6,'SECRETARIA DE TRANSITO Y TRANSPORTE DE LA MOVILIDAD',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetTextColor(2,8,4);
            $pdf->Cell(200,6,'Tarjeta de Control Numero',0,1,'C');
            $pdf->Image('../../vista/imagenes/musical.png' , 170 ,6, 0 , 30,'png');
            $pdf->ln(10);

            //info
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(8);
            $pdf->Cell(15,8,'Fecha: ',0,0,'L');
            $pdf->Cell(30,8,$date,0,1,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,8,'Historial de vencimiento a los proximos 15 dias ',0,0,'C');
            $pdf->ln(15);

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(8);
            $pdf->SetFillColor(200,200,200);
            $pdf->Cell(53,8,'Propietario',1,0,'C',true);
            $pdf->Cell(53,8,'Conductor',1,0,'C',true);
            $pdf->Cell(23,8,'Placa',1,0,'C',true);
            $pdf->Cell(23,8,'Vencimiento',1,0,'C',true);
            $pdf->Cell(23,8,'Fecha',1,1,'C',true);
            //datos
            foreach ($datos as $item) {
                $Propietario    = $item['propietario'];
                $Conductor      = $item['conductor'];
                $Placa          = $item['placa'];
                $Vencimiento    = $item['Vencimiento'];
                $Fecha          = $item['Fecha'];

                $pdf->SetFont('Arial','',9);
                $pdf->Cell(8);
                $pdf->Cell(53,8,$Propietario,1,0,'L');
                $pdf->Cell(53,8,$Conductor,1,0,'L');
                $pdf->Cell(23,8,$Placa,1,0,'C');
                $pdf->Cell(23,8,$Vencimiento,1,0,'C');
                $pdf->Cell(23,8,$Fecha,1,1,'C');


            }
            
            $pdf->Output();
            $this->conexion->conectar();
        } 

}