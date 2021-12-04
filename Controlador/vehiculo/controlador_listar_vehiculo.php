<?php
    require '../../modelo/modelo_vehiculo.php';

    $MU = new modelo_vehiculo();
    $consulta = $MU->listar_vehiculo();
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
