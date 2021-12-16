<?php
session_start();
    class modelo_home{
        private $conexion;
        public $data;

        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
        }
        
        function listar_home(){
            $conn = $this->conexion->conectar();
            $idCompany = $_SESSION['COMPANY'];
            $sql  = "DECLARE @Fecha DATE = DATEADD( DAY, 15, CONVERT ( DATE, GETDATE( ), 1 ) ), @fechaActual DATE = GETDATE( ) 
            SELECT
            * 
            FROM
                (
                SELECT
                    con.id,
                    ( p.nombre + ' ' + p.apellido ) AS conductor,
                    ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                    p.cedula,
                    p.telefono,
                    p.email,
                    v.placa,
                    CONVERT(varchar,con.vLicencia) as vLicencia,
                    CONVERT(varchar,v.vSoat) as vSoat,
                    CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                    @Fecha AS FechaActual,
                CASE
                        
                        WHEN con.vLicencia BETWEEN @fechaActual 
                        AND @Fecha THEN
                            'Licencia' 
                            END AS Vencimiento 
                    FROM
                        conductor AS con
                        INNER JOIN persona AS p ON ( con.idPersona = p.id )
                        INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                        INNER JOIN company AS c ON ( c.id = con.idCompany )
                        INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                        INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                    WHERE
                        pro.estatus = 1 
                        AND c.id = $idCompany 
                    UNION
                    SELECT
                        con.id,
                        ( p.nombre + ' ' + p.apellido ) AS conductor,
                        ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                        p.cedula,
                        p.telefono,
                        p.email,
                        v.placa,
                        CONVERT(varchar,con.vLicencia) as vLicencia,
                        CONVERT(varchar,v.vSoat) as vSoat,
                        CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                        @Fecha AS FechaActual,
                    CASE
                            
                            WHEN v.vMovilizacion BETWEEN @fechaActual 
                            AND @Fecha THEN
                                'Movilizacion' 
                                END AS Vencimiento 
                        FROM
                            conductor AS con
                            INNER JOIN persona AS p ON ( con.idPersona = p.id )
                            INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                            INNER JOIN company AS c ON ( c.id = con.idCompany )
                            INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                            INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                        WHERE
                            pro.estatus = 1 
                            AND c.id = $idCompany 
                        UNION
                        SELECT
                            con.id,
                            ( p.nombre + ' ' + p.apellido ) AS conductor,
                            ( prop.nombre + ' ' + prop.apellido ) AS propietario,
                            p.cedula,
                            p.telefono,
                            p.email,
                            v.placa,
                            CONVERT(varchar,con.vLicencia) as vLicencia,
                            CONVERT(varchar,v.vSoat) as vSoat,
                            CONVERT(varchar,v.vMovilizacion) as vMovilizacion,
                            @Fecha AS FechaActual,
                        CASE
                                
                                WHEN v.vSoat BETWEEN @fechaActual 
                                AND @Fecha THEN
                                    'Soat' 
                                    END AS Vencimiento 
                            FROM
                                conductor AS con
                                INNER JOIN persona AS p ON ( con.idPersona = p.id )
                                INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
                                INNER JOIN company AS c ON ( c.id = con.idCompany )
                                INNER JOIN propietario AS pro ON ( pro.id = v.idPropietario )
                                INNER JOIN persona AS prop ON ( pro.idPersona = prop.id ) 
                            WHERE
                                pro.estatus = 1 
                                AND c.id = $idCompany 
                            ) tablas 
                    WHERE 
                Vencimiento IS NOT NULL
            ";
            $resp = sqlsrv_query($conn, $sql);
            if( $resp === false) {
                return 0;
            }
            $i = 0;
            $Fecha = [];
            $data = [];
            while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
            {
                $data['data'][$i] = $row;
                $Vencimiento = $data['data'][$i]['Vencimiento'];
                $Soat = $data['data'][$i]['vSoat'];
                $Movilizacion = $data['data'][$i]['vMovilizacion'];
                $Licencia = $data['data'][$i]['vLicencia'];

                if($Vencimiento == 'Licencia'){
                    $data['data'][$i]['Fecha'] = $Licencia;
                }else if($Vencimiento == 'Movilizacion'){
                    $data['data'][$i]['Fecha'] = $Movilizacion;
                }elseif ($Vencimiento == 'Soat') {
                    $data['data'][$i]['Fecha'] = $Soat;
                }
                $i++;
            }

            
            
            if($data>0){
                return $data;
            }else{
                return 0;
            }
            
            $this->conexion->conectar();
           
        }








    }