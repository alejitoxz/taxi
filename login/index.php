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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- jQuery -->
    <script src="../vista/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../vista/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../vista/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <img src="img/avatar.jpg" alt="logo" class="avatar">
        <h1>Login</h1>

            <!--Username--->
        <label for="usuario">Usuario</label>
        <input type="text" placeholder="Usuario" id="txt_usu">

        <!--password--->
        <label for="--password---">Contraseña</label>
        <input type="password" placeholder="Contraseña" autocomplete="new-password" id="txt_con">
        <button class="btn btn-primary" type="submit" onclick="VerificarUsuario()">Iniciar Sesión</button>
        <a href="#">Has olvidado tu contraseña</a>


    </div>
	<div class="footer">
		<h1>By: <a href="https://www.visualsat.com/" style="color: #ffffffbe!important;">Visualsat.com</a></h1>

	</div>
    <script src="../js/usuario.js"></script>
</body>
<script>txt_usu.focus()</script>
</html>