<?php
    class modelo_company{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }

        function listar_company(){
            $conn = $this->conexion->conectar();
            $sql  = "SELECT
            id,
            entResp,
            nit
            FROM
            company
            WHERE estatus = 1 AND id not in (1);
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

        function registrar_company($entResp,$nit){
            $conn = $this->conexion->conectar();
            $sql  = "INSERT INTO company(
                    entResp,nit,estatus)
                     VALUES ('$entResp','$nit',1)
                     ";
                   
            $resp = sqlsrv_query($conn, $sql);
            
            if( $resp === false) {
                return 0;
            }else{
                return 1;
            }
            
            $this->conexion->conectar();
        }
        
        function modificar_company($id,$estatus){
            $conn = $this->conexion->conectar();
            $sql  = "UPDATE company set estatus = $estatus
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
        
        function editar_company($id,$entResp,$nit){
            $conn = $this->conexion->conectar();
    
            $sql  = "UPDATE company SET
                    entResp = '$entResp',
                    nit = '$nit'
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