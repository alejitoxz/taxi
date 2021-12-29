<?php
date_default_timezone_set('America/Bogota');
$serverName = "74.208.36.204";
$BD = "taxisCompany";
$USUARIO = "sistemasvsat";
$CLAVE = "mfcvelazvsat";
$connectionInfo = array("Database" => $BD, "UID"=>$USUARIO, "PWD"=>$CLAVE , "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn === false ) {
    echo -1;
    exit;
}

$Id = $_GET['conductor'];

$sql  = "SELECT
        con.id,
        p.id as idPersonaC,
        p.nombre,
        p.apellido,
        (p.nombre + ' ' + p.apellido) AS conductor, 
        p.cedula,
        p.telefono,
        p.email,
        p.direccion,
        (pp.nombre + ' ' + pp.apellido) AS Propietario,
        con.eps,
        CONVERT ( VARCHAR, con.vSeguridad ) AS vSeguridad,
        con.arl,
        con.rh,
        con.fondoPension,
        CONVERT ( VARCHAR, con.vLicencia ) AS vLicencia,
        CONVERT ( VARCHAR, v.vSoat ) AS vSoat,
        CONVERT ( VARCHAR, v.vMovilizacion ) AS vMovilizacion,
        v.nMovilizacion,
        v.placa,
        v.nInterno,
        v.id as idVehiculo,
        c.entResp,
        c.nit
        FROM
        conductor AS con
        INNER JOIN vehiculo AS v ON ( con.idVehiculo = v.id )
        INNER JOIN persona AS p ON ( con.idPersona = p.id )
        INNER JOIN propietario AS pro ON ( v.idPropietario = pro.id ) 
        INNER JOIN persona AS pp ON ( pro.idPersona = pp.id )
        INNER JOIN company AS c ON ( c.id = con.idCompany ) 
        WHERE con.estatus = 1 and con.Id = $Id
";

$resp = sqlsrv_query($conn, $sql);
if( $resp === false) {
    return 0;
}
$i = 0;
while($row = sqlsrv_fetch_array( $resp, SQLSRV_FETCH_ASSOC))
{
    $data[$i] = $row;
    $i++;
}

$Propietario = $data[0]['Propietario'];
$Conductor = $data[0]['conductor'];
$Placa = $data[0]['placa'];
$vLicencia = $data[0]['vLicencia'];
$vSoat = $data[0]['vSoat'];
$vMovilizacion = $data[0]['vMovilizacion'];
$vSeguridad = $data[0]['vSeguridad'];
$Company = $data[0]['entResp'];


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <title>SUTC | VALIDACION QR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Vista/css/style.css">
  <link rel="shortcut icon" href="Vista/imagenes/icon_taxi2.png" />
  <!-- Font Awesome -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <title>CODIGO QR</title>
</head>
<div class="container">
<div class="row justify-content-md-center">
<div class="card">
  <div class="card-header">
    <a href="#" class="text-light"><img src="Vista/imagenes/logo_administracion.png" class="logosIndex"></a>
  </div>
  
  <div class="card-body ">
  <h5>EL SUTC LE INFORMA</h5>
  <b>Nombre del propietario:</b> <?php echo $Propietario; ?><br>
  <b>Nombre del conductor:</b> <?php echo $Conductor; ?><br>
  <b>Placa del vehiculo:</b> <?php echo $Placa; ?><br>
  <b>Compañia asosiaca:</b> <?php echo $Company; ?><br><br>
  <h5>Fechas de vencimientos</h5>
<table class="table table-bordered ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Licencia</th>
      <th scope="col">Soat</th>
      <th scope="col">Movilizacion</th>
      <th scope="col">Seguridad</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $vLicencia; ?></th>
      <td><?php echo $vSoat; ?></td>
      <td><?php echo $vMovilizacion; ?></td>
      <td><?php echo $vSeguridad; ?></td>
    </tr>
  </tbody>
</table>
  </div>
</div>
</div>
</div>

</body>
</html>