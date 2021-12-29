<?php
session_start();
    class modelo_tarjeton{

        function exportar($nombres,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id){
            if($nInterno == 'null'){
                $nInterno = 0;
            }
            if($nombres == 'null'){
                $nombres = 0;
            }
            if($placa == 'null'){
                $placa = 0;
            }
            if($nMovilizacion == 'null'){
                $nMovilizacion = 0;
            }
            if($vLicencia == 'null'){
                $vLicencia = 0;
            }
            if($vMovilizacion == 'null'){
                $vMovilizacion = 0;
            }
            if($vSoat == 'null'){
                $vSoat = 0;
            }
            if($eps == 'null'){
                $eps = 0;
            }
            if($rh == 'null'){
                $rh = 0;
            }
            if($arl == 'null'){
                $arl = 0;
            }
            if($fondoPension == 'null'){
                $fondoPension = 0;
            }
            if($entResp == 'null'){
                $entResp = 0;
            }
            if($nit == 'null'){
                $nit = 0;
            }
            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF('P','cm',ARRAY(25,26));
            $pdf->AddPage();
            $pdf->Image('../../vista/imagenes/tarjeton.jpg' , 0 ,0, 0 , 26,'jpg');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(4.6);
            $pdf->Cell(10);
            $pdf->Cell(10,0,$nombres,0,1,'L');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(1.8);
            $pdf->Cell(7);
            $pdf->Cell(3,0,$placa,0,0,'C');
            $pdf->Cell(4.4);
            $pdf->Cell(2,0,$nInterno,0,0,'C');
            $pdf->Cell(4.7);
            $pdf->Cell(1,0,$nMovilizacion,0,0,'C');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(1.4);
            $pdf->Cell(6);
            $pdf->Cell(3,0,$vLicencia,0,0,'C');
            $pdf->Cell(2.7);
            $pdf->Cell(3,0,$vMovilizacion,0,0,'C');
            $pdf->Cell(2.3);
            $pdf->Cell(3,0,$vSoat,0,0,'C');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(2.5);
            $pdf->Cell(3);
            $pdf->Cell(15,0,$eps,0,0,'L');
            $pdf->Cell(2.7);
            $pdf->Cell(1,0,$rh,0,0,'C');
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(1.8);
            $pdf->Cell(3);
            $pdf->Cell(9,0,$arl,0,0,'L');
            $pdf->Cell(5.4);
            $pdf->Cell(4,0,$fondoPension,0,0,'C');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(2.1);
            $pdf->Cell(7);
            $pdf->Cell(7,0,$entResp,0,0,'L');
            $pdf->Cell(3.5);
            $pdf->Cell(4,0,$nit,0,0,'C');

            $pdf->Ln(2.1);
            $pdf->Image('../../vista/imagenes/qr/qr-'.$id.'.png' , 2.1 ,18.3, 0 , 6,'png');
            
            
           /* $pdf->SetFont('Arial','B',12);
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
            $pdf->SetTextColor(2,2,3);}
            */

       /*     $pdf->Cell(7.2,3,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(2,0.7,'PLACA',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(3,0.7,$placa,0,0,'C',false);

            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4,0.7,'NUMERO INTERNO',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(3,0.7,$nInterno,0,0,'C',false);

            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4,0.7,'NUMERO MOVILIZACION',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(3,0.7,$nMovilizacion,0,1,'C',false);
            $pdf->Ln(0.6);
/*
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(7.2,3,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4.2,0.7,'VENCIMIENTO DE LICENCIA',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(2,0.7,$vLicencia,0,0,'C',false);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(4.5,0.7,'VENCIMIENTO MOVILIZACION',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(2,0.7,$vMovilizacion,0,0,'C',false);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3.2,0.7,'VENCIMIENTO SOAT',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(2,0.7,$vSoat,0,1,'C',false);
            $pdf->Ln(1.2);

            $pdf->Cell(3,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3.2,0.7,'EPS',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(12,0.7,$eps,0,0,'C',false);

            $pdf->Cell(2,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3.5,0.7,'GS. RH',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(2,0.7,$rh,0,1,'C',false);
            $pdf->Ln(0.6);

            $pdf->Cell(3,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3.2,0.7,'ARL',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(8,0.7,$eps,0,0,'C',false);

            $pdf->Cell(1,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(6,0.7,'FONDO DE PENSION',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(4,0.7,$fondoPension,0,1,'C',false);

            $pdf->Ln(0.6);

            $pdf->Cell(3,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(5,0.7,'EMPRESA DE TRANSPORTE',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(6,0.7,$eps,0,0,'C',false);

            $pdf->Cell(3,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.7,'NIT',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(5,0.7,$fondoPension,0,1,'C',false);
            $pdf->Ln(1);

            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(3,2,'',0,0,'L',false);
            $pdf->MultiCell(6,0.3,'NOTA: Para leer el codigo QR y validar este tarjeton instalar la aplicacion de SIGETAX online para celulares Android.',1,1);
            $pdf->Ln(0.1);

            $pdf->Cell(3,1,'',0,0,'L',false);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(6,4,'',1,0,'C',false);

            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(4,1,'',0,0,'L',false);
            $pdf->Cell(1,4,'SISTEMA INTEGRADO DE GESTION',0,0,'C',false);
            $pdf->Ln(2.5);
            $pdf->Cell(11.5,0,'',0,0,'L',false);
            $pdf->Cell(4,0,'EMPRESARIAL TAXI',0,0,'C',false);
*/
            $pdf->Output();
            $this->conexion->conectar();
        } 
    }