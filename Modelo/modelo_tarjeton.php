<?php
session_start();
    class modelo_tarjeton{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function exportar($nombres,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit){
            $conn = $this->conexion->conectar();

            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF('L','cm','A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',12);
            $pdf->Image('../../vista/imagenes/logo-alcaldia.png' , 4 ,1, 0 , 3,'png');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(27.5,1,'ALCALDIA DE IBAGUE',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(27.5,0,'SECRETARIA DE TRANSITO Y TRANSPORTE DE LA MOVILIDAD',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetTextColor(2,8,4);
            $pdf->Cell(27.5,1,'Tarjeta de Control Numero',0,1,'C');
            $pdf->Image('../../vista/imagenes/musical.png' , 23 ,1, 0 , 3,'png');
            $pdf->Ln(2);
            $pdf->Cell(3,3,'',0,0,'L',false);
            $pdf->Cell(3.2,3.5,'',1,0,'L',false);
            $pdf->Cell(1,1,'',0,0,'L',false);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetTextColor(2,2,3);

            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4,0.7,'NOMBRES Y APELLIDOS',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(13,0.7,$nombres,1,1,'C',false);
            $pdf->Ln(0.5);
            
            $pdf->Cell(7.2,3,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4,0.7,'NOMBRES Y APELLIDOS',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(13,0.7,$nombres,1,0,'C',false);

            $pdf->Output();
            $this->conexion->conectar();
        } 
    }