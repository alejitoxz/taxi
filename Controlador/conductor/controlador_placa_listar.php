<?php
    require '../../modelo/modelo_conductor.php';

    $MU = new modelo_conductor();
    $consulta = $MU->listar_placa();
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
