<?php
session_start();
    class modelo_vencimientoPDF{
        private $conexion;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function VencimientoPDF($Propietario,$Conductor,$Placa,$Vencimiento,$Fecha,$Email){
            $conn = $this->conexion->conectar();

            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image('../../vista/imagenes/amarillo.jpg' , 0 ,0, 0 , 25,'jpg');
            
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
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(2,2,3);

            

            $pdf->Output();
            $this->conexion->conectar();
        } 
    }