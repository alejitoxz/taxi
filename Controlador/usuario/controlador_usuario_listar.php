<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new modelo_usuario();

    $consulta = $MU->listar_usuario();
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
