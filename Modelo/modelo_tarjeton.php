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
            
            $pdf->Output();
            $this->conexion->conectar();
        } 
    }