
<div class="col-md-12">
    <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido del usuario</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
                <!-- /.card-tools -->
            </div>
              <!-- /.card-header -->
            <div class="card-body">

            <table id="tabla_usuario" class="display responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Cedula</th>
                          <th>Telefono</th>
                          <th>Email</th>
                          <th>Usuario</th>
                          <th>Rol</th>
                          <th>Compañia</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody id="ListadoUsuarios">
                      </tbody>
              </table>
            </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
</div>
<script type="text/javascript" src="../js/usuario.js"></script>
<script>
    listar_usuario();

</script>
