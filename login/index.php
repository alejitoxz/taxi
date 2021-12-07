<?php
session_start();
if(isset($_SESSION['S_ID'])){
    header('location: ../vista/index.php');
}
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
    
    <title>SUT | INGRESAR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Vista/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../Vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Vista/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <title>Login</title>
</head>

   <!-- <div class="login-box">
        <img src="img/avatar.jpg" alt="logo" class="avatar">
        <h1>Login</h1>

        <label for="usuario">Usuario</label>
        <input type="text" placeholder="Usuario" id="txt_usu">

        <label for="--password---">Contraseña</label>
        <input type="password" placeholder="Contraseña" autocomplete="new-password" id="txt_con">
        <button class="btn btn-primary" type="submit" onclick="VerificarUsuario()">Iniciar Sesión</button>
        <a href="#">Has olvidado tu contraseña</a>


    </div>
	<div class="footer">
		<h1>By: <a href="https://www.visualsat.com/" style="color: #ffffffbe!important;">Visualsat.com</a></h1>

	</div>
-->
<body class="hold-transition login-page fondoTaxi" >
<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-light"><b>SUT</b></a>
  </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sistema Único de Tarjetones</p>

        <div class="input-group mb-3">
          <input type="text" class="form-control" id="txt_usu" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="txt_con" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <br>
          <div class="row justify-content-md-center">
          <div class="col-8">
            <button type="submit" onclick="VerificarUsuario()" class="btn btn-primary btn-block btn-flat ">Iniciar Sesión</button>
          </div>
          </div>
          <br>
          <!-- /.col -->
        </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<script src="../js/usuario.js"></script>
<!-- jQuery -->
<script src="../Vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Vista/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../vista/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../vista/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../vista/plugins/sweetalert2/sweetalert2.all.min.js"></script>
</body>
<script>txt_usu.focus()</script>
</html>