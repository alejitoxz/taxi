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
                        <h3 class="vehiculosRegistrados">0</h3>

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
                    <h3 class="PropietariosRegistrados">0</h3>
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
                    <h3 class="ConductoresRegistrados">0</h3>

                    <p>Conductores</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-id-card"></i>
                    </div>
                    <a onclick="cargar_contenido('contenido_principal','conductor/vista_conductor_listar.php.php')" class="small-box-footer">Conductores Registrados 
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="../js/usuario.js"></script>
<script>
    contarUsuario();
</script>