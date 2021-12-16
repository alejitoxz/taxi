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
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Image('../../vista/imagenes/logo-alcaldia.png' , 18 ,5, 0 , 30,'png');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(200,10,'ALCALDIA DE IBAGUE',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(200,5,'SECRETARIA DE TRANSITO Y TRANSPORTE DE LA MOVILIDAD',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetTextColor(2,8,4);
            $pdf->Cell(200,5,'Tarjeta de Control Numero',0,1,'C');
            $pdf->Image('../../vista/imagenes/musical.png' , 170 ,5, 0 , 30,'png');
            


            

            $pdf->Output();
            $this->conexion->conectar();
        } 
    }