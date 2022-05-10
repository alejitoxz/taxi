<?php
session_start();
if(!isset($_SESSION['ROL'])){
    echo "error de sesion";
exit;
}


    class modelo_barras{

        function exportarbarras($vSeguridad,$fechaActual,$codigo_bar){
           
            require('../../vista/plugins/fpdf/fpdf.php');
            require('../../vista/plugins/codigo_barras/barcode.php');
            $pdf = new FPDF('P','cm',ARRAY(25,26));
            $pdf->AddPage();

            
            $pdf->SetFont('Arial','B',12);

            $vSeguridad = str_replace("-","", $vSeguridad);
            $fechaActual = str_replace("-","", $fechaActual); 

            $texto = $fechaActual.''.$codigo_bar.''.$vSeguridad;
		
            barcode('../../vista/imagenes/br/'.$codigo_bar.'.png', $texto, 40, 'horizontal', 'code128', true);
		
		    $pdf->Image('../../vista/imagenes/br/'.$codigo_bar.'.png',4,4,8,0,'PNG');

            $pdf->Output('D','barras-'.$codigo_bar.'.pdf');
        }
    }