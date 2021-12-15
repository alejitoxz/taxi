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

<div class="col-md-12">
    <div class="card card-primary">
            <div class="card-header">
            <h1 class="card-title"><b>Proximos vencimientos</b></h1>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
                <!-- /.card-tools -->
            </div>
            <table id="tabla_alerta" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Propietario</th>
                          <th>Placa</th>
                          <th>Conductor</th>
                          <th>Cedula</th>
                          <th>Telefono</th>
                          <th>Email</th>
                          <th>Vencimiento licencia</th>
                          <th>Vencimiento Soat</th>
                          <th>Vencimiento Movilidad</th>
                          <th>Editar</th>
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
