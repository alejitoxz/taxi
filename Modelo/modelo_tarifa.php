<?php
    class modelo_tarifa{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_tarifa(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
            id,
            concepto,
            tarifa
            FROM
            tarifa
            WHERE estatus = 1;
            ";
            $resp = sqlsrv_query($conn, $sql);
            if( $resp === false) {
                return 0;
            }
            $i = 0;
            $data = [];
            while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
            {
                $data['data'][] = $row;
                $i++;
            }
            if($data>0){
                return $data;
            }else{
                return 0;
            }
            
            $this->conexion->conectar();
           
        }
        
        function registrar_tarifa($concepto,$tarifa){
            $conn = $this->conexion->conectar();
            $sql  = "INSERT INTO tarifa(
                    concepto,tarifa,estatus)
                     VALUES ('$concepto','$tarifa',1)
                     ";
                   
            $resp = sqlsrv_query($conn, $sql);
            
            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }
        

        function modificar_tarifa($id,$estatus){
            $conn = $this->conexion->conectar();
            $sql  = "UPDATE tarifa set estatus = $estatus
                    WHERE id='$id'
                    ";
                   
            $resp = sqlsrv_query($conn, $sql);
            
            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }


        function editar_tarifa($id,$concepto,$tarifa){
            $conn = $this->conexion->conectar();
    
            $sql  = "UPDATE tarifa SET
                    concepto = '$concepto',
                    tarifa = '$tarifa'
                    WHERE id=$id 
                    ";
                     
            $resp = sqlsrv_query($conn, $sql);
            
            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }

}        