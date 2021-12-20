<?php
session_start();
$Rol = $_SESSION['ROL'];
if ($Rol == 1 || $Rol == 4) {

?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3 id="contadorUsuario">0</h3>

                    <p>Usuarios</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-user-friends"></i>
                    </div>
                    <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')" class="small-box-footer">Usuarios Registrados 
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3 id="contadorVehiculo">0</h3>

                        <p>Vehículos</p>
                        </div>
                        <div class="icon">
                        <i class="fas fa-taxi"></i>
                        </div>
                        <a onclick="cargar_contenido('contenido_principal','vehiculo/vista_vehiculo_listar.php')" class="small-box-footer">Vehículos Registrados 
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                    <h3 id="contadorPropietario">0</h3>
                        <p>Propietarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                        <a onclick="cargar_contenido('contenido_principal','propietario/vista_propietario_listar.php')" class="small-box-footer">Propietarios Registrados 
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
          
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3 id="contadorConductor">0</h3>

                    <p>Conductores</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-id-card"></i>
                    </div>
                    <a onclick="cargar_contenido('contenido_principal','conductor/vista_conductor_listar.php')" class="small-box-footer">Conductores Registrados 
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>

            </div>
        </div>
    </div>
</div> 

<?php
}
?>

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
        <h1 class="card-title"><b>Proximos vencimientos</b></h1>
        </div>
        <div class="card-body">
            <!-- /.card-header -->
            <div class="card-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="col-lg-2">
                    <button type="button" class="btn btn-primary"  onclick="reporte()" ><i class='fa fa-file-pdf'></i>Exportar</button>
                    </div> 
                </div>
            </div>
        <table id="tabla_alerta" class="display responsive nowrap " style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th>#</th>
                    <th>Propietario</th>
                    <th>Placa</th>
                    <th>Conductor</th>
                    <th>Email</th>
                    <th>Vencimiento</th>
                    <th>Fecha</th>
                    <th>Enviar</th>
                </tr>
            </thead>
            <tbody id="Listadohome">
            </tbody>
        </table>
        </div>
            <!-- /.card-body -->
    </div>
            <!-- /.card -->
    </div>
</div>
<script src="../js/home.js"></script>
<script>
  $(document).ready(function(){
    listar_home();
  })
</script>
<script src="../js/usuario.js"></script>
<script src="../js/vehiculo.js"></script>
<script src="../js/propietario.js"></script>
<script src="../js/conductor.js"></script>
<script>
    contarUsuario();
    contarVehiculo();
    contarPropietario();
    contarConductor();
</script>
<style>
    .red{
        background-color:red !important;
    }
</style>
