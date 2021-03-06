<?php
session_start();
if(!isset($_SESSION['ROL'])){
    echo "error de sesion";
exit;
}


    class modelo_tarjeton{

        function exportar($nombres,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id,$tarifas,$control,$ext){
            $Rol = $_SESSION['ROL'];
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
            // VALIMOS ROL
            if($Rol == 3){
                $empresa = "INDEPENDIENTE";
            }else{
                $empresa = $entResp;
            }
            
            if ($ext != '') {
                $foto = "foto-".$id.".".$ext;
            }else{
                $foto = "blanco.jpg";
            }

            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF('P','cm',ARRAY(25,26));
            $pdf->AddPage();
            $pdf->Image('../../vista/imagenes/tarjeton.jpg' , 0 ,0, 0 , 26,'jpg');
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Image('../../vista/imagenes/foto/'.$foto , 1.9 ,5.6, 3.6 , 4.3);

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(3);
            $pdf->Cell(9);
            $pdf->Cell(5,0,$control,0,0,'C');

            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(1.6);
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
            $pdf->Cell(7,0,$empresa,0,0,'L');
            $pdf->Cell(3.5);
            $pdf->Cell(4,0,$nit,0,0,'C');

            $pdf->Ln(2.1);
            $pdf->Image('../../vista/imagenes/qr/qr-'.$id.'.png' , 2.1 ,18.3, 0 , 6,'png');

            
            $pdf->Ln(0.35);
            // Colores, ancho de l??nea y fuente en negrita
            $pdf->SetFont('Arial','B',10);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $header = ['Concepto','Tarifa'];
            $w = array(5.6, 1.5);
            $pdf->Cell(15);
            for($i=0;$i<count($header);$i++){
                $pdf->Cell($w[$i],0.8,$header[$i],1,0,'C',true);
            }
            $pdf->Ln();
            // Restauraci??n de colores y fuentes
            $pdf->SetFillColor(224,235,255);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial','B',8);
            
            // Datos
            $fill = false;
            for ($i=0 ; $i < count($tarifas['data']) ; $i++) {
                $tarifa = $tarifas['data'][$i]['tarifa'];
                $concepto = $tarifas['data'][$i]['concepto'];

                $pdf->Cell(15);
                
                $pdf->Cell($w[0],0.6,$concepto,1,0,'L',$fill);
                // $pdf->Cell(0.2);
                $pdf->Cell($w[1],0.6,$tarifa,1,0,'C',$fill);
                $pdf->Ln(0.6);
                $fill = !$fill;

            }

            
            $pdf->Output();
            $this->conexion->conectar();
        }

        function exportarTarjeton222($dueno,$conductor,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id,$tarifas,$control,$ext,$direccion,$telefono,$tecnoMec){
            $Rol = $_SESSION['ROL'];
            if($nInterno == 'null'){
                $nInterno = 0;
            }
            if($dueno == 'null'){
                $dueno = 0;
            }
            if($conductor == 'null'){
                $conductor = 0;
            }
            if($placa == 'null'){
                $placa = 0;
            }
            if($telefono == 'null'){
                $telefono = 0;
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
            if($direccion == 'null'){
                $direccion = 0;
            }
            
            // VALIMOS ROL
            if($entResp == "INDEPENDIENTE" || $entResp == "ALCALDIA"){
                $empresa = $dueno;
                $nit = $nit;
            }else{
                $empresa = $entResp;
                $nit = $nit;
            }
            
            if ($ext != '') {
                $foto = "foto-".$id.".".$ext;
            }else{
                $foto = "blanco.jpg";
            }

            if($empresa == 'MEGATAXI'){
                $publicidad = "megataxi.jpeg";
            }else if($empresa == 'TUTAXI'){
                $publicidad = "tutaxi.jpeg";
            }else{
                $publicidad = "blanco.jpg";
            }

            require('../../vista/plugins/fpdf/fpdf.php');
            $pdf = new FPDF('P','cm',ARRAY(21.59,27.94));
            $pdf->AddPage();
            $pdf->Image('../../vista/imagenes/marcaagua.png' , 0 ,0, 0 , 28,'png');

            $pdf->Image('../../vista/imagenes/musical.png' ,2.5 ,2.2, 0 , 4,'png');
            $pdf->Image('../../vista/imagenes/alcaldia-ibague.png' , 16 ,2.2, 0 , 4,'png');
            $pdf->SetLeftMargin(2);
            $pdf->SetRightMargin(2);

            $pdf->SetDrawColor(20,100,220);
            $pdf->SetFont('Arial','B',14);
            $pdf->Ln(1.5);
            $pdf->Cell(6);
            $pdf->Cell(6,0.6,"Alcaldia de Ibague",0,1,'C');
            $pdf->Cell(6);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(6,0.6,"Secretaria de Movilidad",0,1,'C');
            $pdf->Cell(6);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(6,0.9,"Tarjeta de Control y Numero",0,1,'C');
            $pdf->Cell(6);
            $pdf->SetFont('Arial','',12);
            $pdf->SetLineWidth(0);
            $pdf->Cell(6,1,$control,1,1,'C');
            // FORM
            $pdf->Ln(0.9);
            $pdf->SetFont('Arial','',11);
            $pdf->line(19.5,7.2,2,7.2);
            $pdf->line(2,20.2,2,7.2);
            $pdf->line(19.5,7.2,19.5,20.2);
            $pdf->line(19.5,20.2,2,20.2);
            //foto
            $pdf->Image('../../vista/imagenes/foto/'.$foto , 2.5 ,7.7, 3.9 , 5.5);
            //nombres
            $pdf->Ln(1.2);
            $pdf->Cell(5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,1,"Nombres",1,0,'C',true);
            // variable nombre
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(9,1,utf8_decode($conductor),1,1,'C');

            //cedula
            $pdf->Ln(0.6);
            $pdf->Cell(5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Cedula",1,0,'C',true);
            // variable cedula
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(9,0.9,$control,1,1,'C');

            //tecno mec anica
            $pdf->Ln(0.6);
            $pdf->Cell(5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Licencia",1,0,'C',true);
            // variable cedula
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$vLicencia,1,0,'C');

            //soat

            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,'Soat',1,0,'C',true);
            // variable cedula
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$vSoat,1,1,'C');

            //Licencia
            $pdf->Ln(0.6);
            $pdf->Cell(5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Tecno Mecanica",1,0,'C',true);
            // variable cedula
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$tecnoMec,1,0,'C');

            //Fondo Pension
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Fondo Pension",1,0,'C',true);
            // variable cedula
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$fondoPension,1,1,'C');

            //direccion
            $pdf->Ln(0.6);
            $pdf->Cell(0.5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Direccion",1,0,'C',true);
            // variable telefono
            $pdf->SetFont('Arial','B',8);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(7.5,0.9,utf8_decode($direccion),1,0,'C');

            //telefono
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Telefono",1,0,'C',true);
            // variable direccion
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$telefono,1,1,'C');

            //empresa
            $pdf->Ln(0.6);
            $pdf->Cell(0.5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Empresa",1,0,'C',true);
            // variable rh
            $pdf->SetFont('Arial','B',9);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(7.5,0.9,$empresa,1,0,'C');

            //placa
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"Placa",1,0,'C',true);
            // variable rh
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(3,0.9,$placa,1,1,'C');

            //EPS
            $pdf->Ln(0.6);
            $pdf->Cell(0.5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"RH",1,0,'C',true);
            // variable EPS
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(5.3,0.9,utf8_decode($rh),1,0,'C');
            //ALR
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"EPS",1,0,'C',true);
            // variable ALR
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(5.2,0.9,utf8_decode($eps),1,1,'C');

            //arl
            $pdf->Ln(0.6);
            $pdf->Cell(0.5);
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"ARL",1,0,'C',true);
            // variable EMPRESA
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(5.3,0.9,utf8_decode($arl),1,0,'C');

            //NIT
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetDrawColor(50);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            $pdf->Cell(3,0.9,"NIT",1,0,'C',true);
            // variable NIT
            $pdf->SetFont('Arial','B',11);
            $pdf->SetFillColor(0);
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(20,100,220);
            $pdf->Cell(5.2,0.9,$nit,1,1,'C');

            
            
            // QR, VIBRA, PUBLICIDAD Y TARIFAS            
            $pdf->Image('../../vista/imagenes/qr/qr-'.$id.'.png' , 2 ,20.6, 0 , 5.5,'png');
            $pdf->Image('../../vista/imagenes/vibra.png' , 9.4 ,24.2, 0 , 1.5,'png');
            $pdf->Ln(1.1);
            $pdf->Cell(11.2);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(6.3,0.6,"DECRETO 0943 / 0944",0,1,'L');
            // Colores, ancho de l??nea y fuente en negrita
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            
            $header = ['Concepto','Tarifa'];
            $w = array(4.8, 1.3);
            $pdf->Cell(11.2);
            for($i=0;$i<count($header);$i++){
                $pdf->Cell($w[$i],0.5,$header[$i],1,0,'C',true);
            }
            $pdf->Ln();
            // Restauraci??n de colores y fuentes
            $pdf->SetFillColor(224,235,255);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial','B',7);
            $fill = false;
            for ($i=0 ; $i < count($tarifas['data']) ; $i++) {
                $tarifa = $tarifas['data'][$i]['tarifa'];
                $concepto = $tarifas['data'][$i]['concepto'];

                $pdf->Cell(11.2);
                $pdf->Cell($w[0],0.4,$concepto,1,0,'L',$fill);
                $pdf->Cell($w[1],0.4,$tarifa,1,0,'C',$fill);
                $pdf->Ln(0.4);
                $fill = !$fill;

            }
            

            //$pdf->Output('D','Tarjeton-'.$id.'.pdf');
            $pdf->Output();
            //$this->conexion->conectar();
        }

        function exportarTarjeton($dueno,$conductor,$placa,$nInterno,$nMovilizacion,$vLicencia,$vMovilizacion,$vSoat,$eps,$rh,$arl,$fondoPension,$entResp,$nit,$id,$tarifas,$control,$ext,$direccion,$telefono,$tecnoMec){
            $Rol = $_SESSION['ROL'];
            if($nInterno == 'null'){
                $nInterno = 0;
            }
            if($dueno == 'null'){
                $dueno = 0;
            }
            if($conductor == 'null'){
                $conductor = 0;
            }
            if($placa == 'null'){
                $placa = 0;
            }
            if($telefono == 'null'){
                $telefono = 0;
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
            if($direccion == 'null'){
                $direccion = 0;
            }
            if($control == 'null'){
                $control = 0;
            }
            
            // VALIMOS ROL
            if($entResp == "INDEPENDIENTE" || $entResp == "ALCALDIA"){
                $empresa = $dueno;
                $nit = $nit;
            }else{
                $empresa = $entResp;
                $nit = $nit;
            }
            
            if ($ext != '') {
                $foto = "foto-".$id.".".$ext;
            }else{
                $foto = "blanco.jpg";
            }

            //echo $foto;exit;
            if($empresa == 'MEGATAXI'){
                $publicidad = "megataxi.jpeg";
            }else if($empresa == 'TUTAXI'){
                $publicidad = "tutaxi.jpeg";
            }else{
                $publicidad = "blanco.jpg";
            }

            //require('../../vista/plugins/fpdf/fpdf.php');
            require('../../vista/plugins/image_alpha/image_alpha.php');

           // $pdf=new PDF_ImageAlpha();

            $pdf = new PDF_ImageAlpha('p','cm',ARRAY(26,26));
            $pdf->SetFont('Arial','B',20);
            $pdf->AddPage();
            // Tarjeton
            $pdf->Image('../../vista/imagenes/tarjetonactualizado.jpeg' , 0 ,0, 26, 26,'jpeg');
            // control
            $pdf->Ln(2.5);
            $pdf->Cell(8);
            $pdf->Cell(8,1,$control,0,1,'C');
            //foto
            $pdf->Image('../../vista/imagenes/foto/'.$foto , 2.3 ,5.7, 3.6 , 4.1);
            // Nombre
            $pdf->Ln(0.6);
            $pdf->Cell(11);
            $pdf->Cell(10,1,$conductor,0,1,'L');
            // PLACA
            $pdf->Ln(0.8);
            $pdf->Cell(7);
            $pdf->Cell(3,1,$placa,0,0,'C');
            // INTERNO
            $pdf->Cell(4.2);
            $pdf->Cell(2.4,1,$nInterno,0,0,'C');
            // movilizacion
            $pdf->Cell(2);
            $pdf->Cell(1.5,0,$nMovilizacion,0,1,'C');
            // licencia
            $pdf->Ln(1.3);
            $pdf->Cell(5.8);
            $pdf->Cell(3.9,1,$vLicencia,0,0,'C');
            // vmov
            $pdf->Cell(2);
            $pdf->Cell(3.9,1,$vMovilizacion,0,0,'C');
            // soat
            $pdf->Cell(1.5);
            $pdf->Cell(3.9,1,$vSoat,0,1,'C');
            // EPS
            $pdf->Ln(1.6);
            $pdf->Cell(3.8);
            $pdf->Cell(15,1,$eps,0,0,'L');
            // RH
            $pdf->Cell(2.7);
            $pdf->Cell(2,1,$rh,0,1,'L');
            // ARL
            $pdf->Ln(0.8);
            $pdf->Cell(4);
            $pdf->Cell(9,1,$arl,0,0,'L');
            // PENSION
            $pdf->Cell(5);
            $pdf->Cell(5,1,$fondoPension,0,1,'L');
            // empresa
            $pdf->Ln(1);
            $pdf->Cell(7.2);
            $pdf->Cell(8.5,1,$empresa,0,0,'L');
            // nit
            $pdf->Cell(2.2);
            $pdf->Cell(5,1,$nit,0,1,'L');
            
            // QR         
            $pdf->Image('../../vista/imagenes/qr/qr-'.$id.'.png' , 2.6 ,18.5, 0 , 5.4,'png');
            // TARIFAS   
            $pdf->Ln(1.5); 
            $pdf->Cell(17);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(6.3,0.6,"DECRETO 0943 / 0944",0,1,'L');
            // Colores, ancho de l??nea y fuente en negrita
            $pdf->SetLineWidth(0);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetFillColor(20,100,220);
            $pdf->SetTextColor(255,255,255);
            
            $header = ['Concepto','Tarifa'];
            $w = array(5.7, 1.4);
            $pdf->Cell(15.6);
            for($i=0;$i<count($header);$i++){
                $pdf->Cell($w[$i],0.7,$header[$i],1,0,'C',true);
            }
            $pdf->Ln();
            // Restauraci??n de colores y fuentes
            $pdf->SetFillColor(224,235,255);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial','B',8);
            $fill = false;
            for ($i=0 ; $i < count($tarifas['data']) ; $i++) {
                $tarifa = $tarifas['data'][$i]['tarifa'];
                $concepto = $tarifas['data'][$i]['concepto'];

                $pdf->Cell(15.6);
                $pdf->Cell($w[0],0.5,$concepto,1,0,'L',$fill);
                $pdf->Cell($w[1],0.5,$tarifa,1,0,'C',$fill);
                $pdf->Ln(0.5);
                $fill = !$fill;

            }
            

            //$pdf->Output('D','Tarjeton-'.$id.'.pdf');
            $pdf->Output();
            //$this->conexion->conectar();
        }

        
    }