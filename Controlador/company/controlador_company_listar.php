<?php
    require '../../modelo/modelo_company.php';

    $MU = new modelo_company();
    $consulta = $MU->listar_company();
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
