<?php
session_start();
if(!isset($_SESSION['S_ID'])){
    header('location: ../login/index.php');
}

$Datos = $_SESSION['Datos'];

// DATOS DE SESION USUARIO ROLES
$Ente = $_SESSION['ENTE'];



/*for ($i=0; $i < count($Datos); $i++) { 
  $Modulos = $Datos[$i]['modulos'];
  echo $Modulos;
  
  if(isset($Datos[$i]['submodulos'])){
    for ($k=0; $k < count($Datos[$i]['submodulos']); $k++) { 
      //for ($x=0; $x < count($Datos[$i]['submodulos'][$x]); $x++) { 
       // var_dump($Datos[$i]['submodulos'][$x]['descripcion']);
        $SubDescripcion = $Datos[$i]['submodulos'][$k]['descripcion'];
        $SubUrl = $Datos[$i]['submodulos'][$k]['url'];
        $SubIcon = $Datos[$i]['submodulos'][$k]['icon'];
        
        echo $SubUrl." - ";
      //}
    } 
  }
  
}

exit;*/


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Visualsat | SUTC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../Vista/imagenes/icon_taxi2.png" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../plantilla/DataTables/datatables.min.css">
  <link rel="stylesheet" href="../plantilla/select2/select2.min.css">
</head>
<body class="sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
   
    <!-- Notifications Dropdown Menu --> 
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="../controlador/usuario/controlador_cerrar_sesion.php">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light"><?php echo $Ente;  ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['USUARIO'];  ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          
          
<?php
  for ($i=0; $i < count($Datos); $i++) { 
    $Modulos = $Datos[$i]['modulos'];
    if($Modulos == "Inicio"){
      $IconoMenu = "nav-icon fas fa-chart-pie"; 
      $Desploy = ""; 
      $base = "cargar_contenido('contenido_principal','home/home.php')"; 
    }else if($Modulos == "Configuracion"){
      $IconoMenu = "nav-icon fas fa-cog"; 
      $Desploy = "right fas fa-angle-left";
      $base = ""; 
    }
    else if($Modulos == "Bases de datos"){
      $IconoMenu = "nav-icon fas fa-edit"; 
      $Desploy = "right fas fa-angle-left";
      $base = ""; 
    }
    
    
?>
<!-- MODULOS -->
            <li class="nav-item has-treeview">
              <a  class="nav-link nav-active" onclick="<?php echo $base; ?>">
              <i class="<?php echo $IconoMenu; ?>"></i>
              <p>
              <?php echo $Modulos; ?>
              <i class="<?php echo $Desploy; ?>"></i>
              </p>
            </a>
<?php
if(isset($Datos[$i]['submodulos'])){
  for ($k=0; $k < count($Datos[$i]['submodulos']); $k++) { 

      $SubDescripcion = $Datos[$i]['submodulos'][$k]['descripcion'];
      $SubUrl = $Datos[$i]['submodulos'][$k]['url'];
      $SubIcon = $Datos[$i]['submodulos'][$k]['icon'];

  

?>
<!-- SUB MODULOS -->
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a onclick="cargar_contenido('contenido_principal','<?php echo $SubUrl; ?>')" class="nav-link nav-active">
                  <i class="<?php echo $SubIcon; ?>"></i>
                  <p><?php echo $SubDescripcion; ?></p>
                </a>
              </li>
              <!--<li class="nav-item">
              <a onclick="cargar_contenido('contenido_principal','propietario/vista_propietario_listar.php')" class="nav-link">
                  <i class="fas fa-building"></i>
                  <p>Propietario</p>
                </a>
              </li>
              <li class="nav-item">
              <a onclick="cargar_contenido('contenido_principal','conductor/vista_conductor_listar.php')" class="nav-link">
                  <i class="fas fa-building"></i>
                  <p>Conductor</p>
                </a>
              </li>-->
            </ul>
<?php
      
    }
  }
}
?>
<!-- FIN MODULOS -->
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
          <img src="../Vista/imagenes/logo_administracion2021.png" class="logosHome">
            <h1 class="m-0 text-dark">Bienvenidos al SUTC - SISTEMA UNICO DE TARJETONES DE COLOMBIA</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
<!--dash -->
    <section class="content">
      <div clas="row" id="contenido_principal">
       
        </div>
      </div>
    </section>

  <footer class="main-footer">
    <strong><a href="https://www.visualsat.com">Visualsat</a></strong>
   Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  var idioma_espanol = {
			select: {
			rows: "%d fila seleccionada"
			},
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
			"sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "<b>No se encontraron datos</b>",
			"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
			},
			"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
	 }
   cargar_contenido('contenido_principal','home/home.php');
  function cargar_contenido(contenedor,contenido){
    $("#"+contenedor).load(contenido);
  }
  $.widget.bridge('uibutton', $.ui.button)

  $('.nav-active').on('click', function (e) {
  e.preventDefault()
  $('.nav-active').removeClass("active");
  $(this).addClass("active");
})

</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://kit.fontawesome.com/3a4b2807a0.js" crossorigin="anonymous"></script>
<script src="../plantilla/DataTables/datatables.min.js" ></script>
<script src="../plantilla/select2/select2.min.js" ></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

</body>
</html>
