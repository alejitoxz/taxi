<?php
    require '../../modelo/modelo_tarifa.php';

    $MU = new modelo_tarifa();
    $consulta = $MU->listar_tarifa();
    if($consulta){
        echo json_encode($consulta);
    }else {
        echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';
    }
